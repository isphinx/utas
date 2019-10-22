using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Collections.ObjectModel;

namespace KIT506_ASSIGNMENT2_WPF.Controller
{
    class ResearcherController
    {
        private readonly ObservableCollection<Researcher> researchers = null;
        // private readonly ObservableCollection<Position> positions = null;
        private static double[,] PERFORMANCE_RANGE = new double[4, 2] {
             {0.0, 70.0},
             {70.0, 110.0},
             {110.0, 200.0},
             {200.0, 999.0}
        };


        public ObservableCollection<Researcher> Researchers { get { return researchers; } }

        public ResearcherController()
        {
            researchers = Database.GetInstance().GetResearchers();
            // positions = Database.GetInstance().GetPosition();
            foreach (var p in researchers)
            {
                p.ThreeYearAve = Database.GetInstance().GetThreeAve(p.ID) / 3.0;
                // performance
                if (p.Level == LEVEL.STUDENT_ONLY)
                    p.Performance = 0;
                else
                    p.Performance = p.ThreeYearAve / Researcher.EXPECTED_PUBLICATION[p.Level] * 100;
            }
        }

        public ObservableCollection<Researcher> FilterResearcherbyName(string name)
        {
            var result = from Researcher r in Researchers
                         where r.GivenName.ToUpper().Contains(name.ToUpper()) || r.FamilyName.ToUpper().Contains(name.ToUpper())
                         select r;

            return new ObservableCollection<Researcher>(result.ToList());
        }

        public ObservableCollection<Researcher> FilterResearcherbyLevel(LEVEL level)
        {
            var result = from Researcher r in Researchers
                         where r.Level == level
                         select r;

            return new ObservableCollection<Researcher>(result.ToList());
        }

        public string GetCumulativeCount(Researcher researcher)
        {
            var publications = researcher.Publications;

            // var dtSummary = from q in table.AsEnumerable()
            //               group q by new { 列名2= q.Field<int>("列名2")} into g
            //               select new
            //               {
            //                   列名2= g.Key.列名2,
            //                   数值或金额汇总列名= g.Sum(a => a.Field<decimal>("数值或金额列名"))
            //               };
            // 
            var result = from p in publications
                         group p by new { p.Year } into g
                         select new
                         {
                             year = g.Key.Year,
                             count = g.Count()
                         };

            string str = "Year    Count\n";
            result.ToList().ForEach(r => str += string.Format("{0}    {1}\n", r.year, r.count));
            return string.Join("\n", str);
        }

        public string GetSupervisionNames(ObservableCollection<Supervision> supervision)
        {
            // var query = list.Where(r => listofIds.Any(id => id == r.Id));
            // from r in list join i in listofIds on r.Id equals i select r
            // var result = researchers.Where(r => supervision.Any(s => s.StudentID == r.ID));
            var result = from r in researchers
                         join s in supervision on r.ID equals s.StudentID
                         select new
                         {
                             r.GivenName,
                             r.FamilyName,
                             r.Title,
                         };
            string str = "";
            result.ToList().ForEach(r => str += string.Format("{0} {1} ({2})\n", r.GivenName, r.FamilyName, r.Title));
            return string.Join("\n", str);
        }

        public dynamic GetPerformance(int performanceLevel)
        {
            var l1 = PERFORMANCE_RANGE[performanceLevel, 0];
            var l2 = PERFORMANCE_RANGE[performanceLevel, 1];
            var result = from r in researchers
                         where r.Performance > PERFORMANCE_RANGE[performanceLevel, 0] &&
                                r.Performance < PERFORMANCE_RANGE[performanceLevel, 1]
                         select new
                         {
                             Performance = r.Performance,
                             GivenName = r.GivenName,
                             FamilyName = r.FamilyName,
                             Email = r.Email,
                         };

            return result.ToList();
        }

        public Researcher GetResearcher(RESEARCHER_TYPE type, int id)
        {
            return Database.GetInstance().GetResearcher(type, id);
        }
    }
}
