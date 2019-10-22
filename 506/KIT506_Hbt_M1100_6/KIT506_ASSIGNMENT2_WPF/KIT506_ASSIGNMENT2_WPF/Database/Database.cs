using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Collections.ObjectModel;

using MySql.Data.MySqlClient;
using MySql.Data.Types;

namespace KIT506_ASSIGNMENT2_WPF
{
    class Utility
    {
        public static string GetJobTitle(LEVEL level)
        {
            switch (level)
            {
                case LEVEL.A: return "Postdoc";
                case LEVEL.B: return "Lecturer";
                case LEVEL.C: return "Senior Lecturer";
                case LEVEL.D: return "Associate Professor";
                case LEVEL.E: return "Professor";
                case LEVEL.STUDENT_ONLY: return "Student";
                default: return "error";
            }
        }

        public static LEVEL LEVEL_Parse(string s)
        {
            return (LEVEL)Enum.Parse(typeof(LEVEL), s);
        }
    }
    class Database
    {
        private const string dbname = "kit206";
        private const string user = "kit206";
        private const string pw = "kit206";
        private const string server = "alacritas.cis.utas.edu.au";
        private MySqlConnection db = null;

        private static Database singleton = null;
        private Database()
        {
            string connectionString = String.Format("Database={0};Data Source={1};User Id={2};Password={3}",
                dbname, server, user, pw);
            db = new MySqlConnection(connectionString);
        }

        public static Database GetInstance()
        {
            if (singleton == null)
                singleton = new Database();

            return singleton;
        }

        private void ReportError(string msg, Exception e)
        {
            MessageBox.Show("An error occurred while " + msg + ". Try again later.\n\nError Details:\n" + e,
                "Error", MessageBoxButton.OK, MessageBoxImage.Error);
        }

        public ObservableCollection<Researcher> GetResearchers()
        {
            ObservableCollection<Researcher> researchers = new ObservableCollection<Researcher>();

            MySqlDataReader rd = null;

            try
            {
                db.Open();

                MySqlCommand cmd = new MySqlCommand("select id, type, given_name, family_name, title, unit, level, email from researcher", db);
                rd = cmd.ExecuteReader();

                while (rd.Read())
                {
                    var researcher = new Researcher
                    {
                        ID = rd.GetInt32(0),
                        Type = (RESEARCHER_TYPE)Enum.Parse(typeof(RESEARCHER_TYPE), rd.GetString(1)),
                        GivenName = rd.GetString(2),
                        FamilyName = rd.GetString(3),
                        Title = rd.GetString(4),
                        Unit = rd.GetString(5),
                        Level = rd.IsDBNull(6) ? LEVEL.STUDENT_ONLY : Utility.LEVEL_Parse(rd.GetString(6)),
                        Email = rd.GetString(7),
                    };
                    researcher.JobTitle = Utility.GetJobTitle(researcher.Level);

                    researchers.Add(researcher);
                }
            }
            catch (MySqlException e)
            {
                ReportError("loading staff", e);
            }
            finally
            {
                if (rd != null)
                    rd.Close();
                if (db != null)
                    db.Close();
            }

            return researchers;
        }

        //        public ObservableCollection<Researcher> GetResearchers1()
        //        {
        //            ObservableCollection<Researcher> researchers = new ObservableCollection<Researcher>();
        //
        //            MySqlDataReader rd = null;
        //
        //            var rpulication = GetResearcherPublications();
        //            var allpulications = GetPublication();
        //            var positions = GetPosition();
        //            var supervisions = GetSupervision();
        //
        //            try
        //            {
        //                db.Open();
        //
        //                MySqlCommand cmd = new MySqlCommand("select r1.id, r1.type, r1.given_name, r1.family_name, r1.title, r1.unit, r1.campus, r1.email, r1.photo, r1.degree, r1.supervisor_id, r1.level, r1.utas_start, r1.current_start, r2.given_name as supervisorGN, r2.family_name as supervisorFN from researcher as r1 left join researcher as r2 on r1.supervisor_id=r2.id", db);
        //                rd = cmd.ExecuteReader();
        //
        //                while (rd.Read())
        //                {
        //                    var researcher = new Researcher
        //                    {
        //                        ID = rd.GetInt32(0),
        //                        Type = (RESEARCHER_TYPE)Enum.Parse(typeof(RESEARCHER_TYPE), rd.GetString(1)),
        //                        GivenName = rd.GetString(2),
        //                        FamilyName = rd.GetString(3),
        //                        Title = rd.GetString(4),
        //                        Unit = rd.GetString(5),
        //                        Campus = (CAMPUS)Enum.Parse(typeof(CAMPUS), rd.GetString(6).Replace(' ', '_')),
        //                        Email = rd.GetString(7),
        //                        Photo = rd.GetString(8),
        //                        Degree = rd.IsDBNull(9) ? "" : rd.GetString(9),
        //                        SupervisorID = rd.IsDBNull(10) ? 0 : rd.GetInt32(10),
        //                        Level = rd.IsDBNull(11) ? LEVEL.STUDENT_ONLY : Utility.LEVEL_Parse(rd.GetString(11)),
        //                        UtasStart = DateTime.Parse(rd.GetString(12)),
        //                        CurrentStart = DateTime.Parse(rd.GetString(13)),
        //                        SupervisorGivenName = rd.IsDBNull(14) ? "" : rd.GetString(14),
        //                        SupervisorFamilyName = rd.IsDBNull(14) ? "" : rd.GetString(15),
        //                    };
        //                    researcher.JobTitle = Utility.GetJobTitle(researcher.Level);
        //
        //                    // publication
        //                    var publications = from ResearcherPublication rp in rpulication
        //                                       join Publication pu in allpulications on rp.DOI equals pu.DOI
        //                                       orderby pu.Year
        //                                       where rp.ResearcherID == researcher.ID
        //                                       select pu;
        //                    researcher.Publications = new ObservableCollection<Publication>(publications.ToList());
        //                    researcher.CumulativeCount = publications.Count();
        //
        //                    // 3 year average
        //                    var threeYearPublication = from p in publications
        //                                               where p.Year == "2016" || p.Year == "2017" || p.Year == "2018"
        //                                               select p;
        //                    researcher.ThreeYearAve = threeYearPublication.Count() / 3.0;
        //
        //                    // positions
        //                    var thisPositions = from Position p in positions
        //                                        where p.ID == researcher.ID
        //                                        select p;
        //                    researcher.positions = new ObservableCollection<Position>(thisPositions.ToList());
        //
        //                    // supervision
        //                    var thisSupervisions = from Supervision su in supervisions
        //                                           where su.StaffID == researcher.ID
        //                                           select su;
        //                    researcher.Supervisions = new ObservableCollection<Supervision>(thisSupervisions.ToList());
        //                    researcher.SupervisorCount = thisSupervisions.Count();
        //
        //                    // Tenure
        //                    researcher.Tenure = (DateTime.Now - researcher.UtasStart).TotalDays / 365;
        //
        //                    // performance
        //                    if(researcher.Level == LEVEL.STUDENT_ONLY)
        //                    {
        //                        researcher.Performance = 0;
        //                    }
        //                    else
        //                    {
        //                        researcher.Performance = researcher.ThreeYearAve / Researcher.EXPECTED_PUBLICATION[researcher.Level] * 100;
        //                    }
        //
        //                    researchers.Add(researcher);
        //                }
        //            }
        //            catch (MySqlException e)
        //            {
        //                ReportError("loading staff", e);
        //            }
        //            finally
        //            {
        //                if (rd != null)
        //                    rd.Close();
        //                if (db != null)
        //                    db.Close();
        //            }
        //
        //            return researchers;
        //        }

        public Researcher GetResearcher(RESEARCHER_TYPE type, int id)
        {
            MySqlDataReader rd = null;

            Researcher researcher;
            if (type == RESEARCHER_TYPE.Student)
                researcher = new Model.Student();
            else
                researcher = new Model.Stuff();

            try
            {
                db.Open();

                MySqlCommand cmd = new MySqlCommand("select r1.id, r1.type, r1.given_name, r1.family_name, r1.title, r1.unit, r1.campus, r1.email, r1.photo, r1.degree, r1.supervisor_id, r1.level, r1.utas_start, r1.current_start, r2.given_name as supervisorGN, r2.family_name as supervisorFN from researcher as r1 left join researcher as r2 on r1.supervisor_id=r2.id where r1.id=" + id.ToString(), db);
                rd = cmd.ExecuteReader();

                rd.Read();
                {
                    researcher.ID = rd.GetInt32(0);
                    researcher.Type = (RESEARCHER_TYPE)Enum.Parse(typeof(RESEARCHER_TYPE), rd.GetString(1));
                    researcher.GivenName = rd.GetString(2);
                    researcher.FamilyName = rd.GetString(3);
                    researcher.Title = rd.GetString(4);
                    researcher.Unit = rd.GetString(5);
                    researcher.Campus = (CAMPUS)Enum.Parse(typeof(CAMPUS), rd.GetString(6).Replace(' ', '_'));
                    researcher.Email = rd.GetString(7);
                    researcher.Photo = rd.GetString(8);
                    if (researcher is Model.Student student)
                        student.Degree = rd.IsDBNull(9) ? "" : rd.GetString(9);
                    researcher.SupervisorID = rd.IsDBNull(10) ? 0 : rd.GetInt32(10);
                    researcher.Level = rd.IsDBNull(11) ? LEVEL.STUDENT_ONLY : Utility.LEVEL_Parse(rd.GetString(11));
                    researcher.UtasStart = DateTime.Parse(rd.GetString(12));
                    researcher.CurrentStart = DateTime.Parse(rd.GetString(13));
                    researcher.SupervisorGivenName = rd.IsDBNull(14) ? "" : rd.GetString(14);
                    researcher.SupervisorFamilyName = rd.IsDBNull(14) ? "" : rd.GetString(15);
                    researcher.JobTitle = Utility.GetJobTitle(researcher.Level);
                }
            }
            catch (MySqlException e)
            {
                ReportError("loading staff", e);
            }
            finally
            {
                if (rd != null)
                    rd.Close();
                if (db != null)
                    db.Close();
            }

            // publication
            researcher.Publications = GetPublication(id);
            researcher.CumulativeCount = researcher.Publications.Count();

            // positions
            if (researcher is Model.Stuff stuff)
                stuff.Positions = GetPosition(id);

            // 3 year average
            var threeYearPublication = from p in researcher.Publications
                                       where p.Year == "2016" || p.Year == "2017" || p.Year == "2018"
                                       select p;
            researcher.ThreeYearAve = threeYearPublication.Count() / 3.0;


            // supervision
            researcher.Supervisions = GetSupervision(id);
            researcher.SupervisorCount = researcher.Supervisions.Count();

            // Tenure
            researcher.Tenure = (DateTime.Now - researcher.UtasStart).TotalDays / 365;

            // performance
            if (researcher.Level == LEVEL.STUDENT_ONLY)
                researcher.Performance = 0;
            else
                researcher.Performance = researcher.ThreeYearAve / Researcher.EXPECTED_PUBLICATION[researcher.Level] * 100;
            return researcher;
        }

        private ObservableCollection<ResearcherPublication> GetResearcherPublications(int id)
        {
            var rpublication = new ObservableCollection<ResearcherPublication>();
            MySqlDataReader rd = null;

            try
            {
                db.Open();

                MySqlCommand cmd = new MySqlCommand(
                    string.Format("select researcher_id, doi from researcher_publication where id={0}", id),
                    db);
                rd = cmd.ExecuteReader();

                while (rd.Read())
                {
                    rpublication.Add(new ResearcherPublication { ResearcherID = rd.GetInt32(0), DOI = rd.GetString(1) });
                }
            }
            catch (MySqlException e)
            {
                ReportError("loading researcher_pulications", e);
            }
            finally
            {
                if (rd != null)
                    rd.Close();
                if (db != null)
                    db.Close();
            }

            return rpublication;

        }

        public ObservableCollection<Position> GetPosition(int id)
        {
            var position = new ObservableCollection<Position>();

            MySqlDataReader rd = null;

            try
            {
                db.Open();

                MySqlCommand cmd = new MySqlCommand(
                    string.Format("select id, level, start, end from position where id={0}", id),
                    db);
                rd = cmd.ExecuteReader();

                while (rd.Read())
                {
                    if (rd.IsDBNull(3))
                        continue;
                    var p = new Position
                    {
                        ID = rd.GetInt32(0),
                        Level = rd.IsDBNull(1) ? LEVEL.STUDENT_ONLY : Utility.LEVEL_Parse(rd.GetString(1)),
                        Start = DateTime.Parse(rd.GetString(2)),
                        End = DateTime.Parse(rd.GetString(3)),
                    };
                    p.JobTitle = Utility.GetJobTitle(p.Level);
                    position.Add(p);
                }
            }
            catch (MySqlException e)
            {
                ReportError("loading position", e);
            }
            finally
            {
                if (rd != null)
                    rd.Close();
                if (db != null)
                    db.Close();
            }

            return position;
        }

        public ObservableCollection<Publication> GetPublication(int id)
        {
            var publications = new ObservableCollection<Publication>();

            MySqlDataReader rd = null;

            try
            {
                db.Open();
                MySqlCommand cmd = new MySqlCommand(
                    string.Format("select p.doi, p.title, p.authors, p.year, p.type, p.cite_as, p.available from publication p, researcher_publication r where p.doi=r.doi and r.researcher_id={0} order by p.year", id),
                    db);
                rd = cmd.ExecuteReader();

                while (rd.Read())
                {
                    var pu = new Publication
                    {
                        DOI = rd.GetString(0),
                        Title = rd.GetString(1),
                        Authors = rd.GetString(2),
                        Year = rd.GetString(3),
                        Type = (PUBLICATIONS_TYPE)Enum.Parse(typeof(PUBLICATIONS_TYPE), rd.GetString(4)),
                        CiteAS = rd.GetString(5),
                        Available = DateTime.Parse(rd.GetString(6)),
                    };
                    pu.Age = (DateTime.Now - pu.Available).TotalDays;
                    publications.Add(pu);
                }
            }
            catch (MySqlException e)
            {
                ReportError("loading position", e);
            }
            finally
            {
                if (rd != null)
                    rd.Close();
                if (db != null)
                    db.Close();
            }

            return publications;
        }

        public ObservableCollection<Supervision> GetSupervision(int id)
        {
            var supervisons = new ObservableCollection<Supervision>();

            MySqlDataReader rd = null;

            try
            {
                db.Open();
                MySqlCommand cmd = new MySqlCommand(
                    string.Format("select Staff_ID, Student_ID from supervision where Staff_ID={0}", id),
                    db);
                rd = cmd.ExecuteReader();

                while (rd.Read())
                {
                    supervisons.Add(new Supervision { StaffID = rd.GetInt32(0), StudentID = rd.GetInt32(1) });
                }
            }
            catch (MySqlException e)
            {
                ReportError("loading position", e);
            }
            finally
            {
                if (rd != null)
                    rd.Close();
                if (db != null)
                    db.Close();
            }

            return supervisons;
        }

        public int GetThreeAve(int id)
        {
            MySqlDataReader rd = null;

            try
            {
                db.Open();
                MySqlCommand cmd = new MySqlCommand(
                    "select count(*) from publication as p, researcher_publication as r where p.doi=r.doi and (year=2016 or year=2017 or year=2018) and r.researcher_id=" + id.ToString(),
                    db);
                rd = cmd.ExecuteReader();

                if (rd.Read())
                {
                    return rd.GetInt32(0);
                }
            }
            catch (MySqlException e)
            {
                ReportError("loading 3ave", e);
            }
            finally
            {
                if (rd != null)
                    rd.Close();
                if (db != null)
                    db.Close();
            }
            return 0;
        }
    }

}

