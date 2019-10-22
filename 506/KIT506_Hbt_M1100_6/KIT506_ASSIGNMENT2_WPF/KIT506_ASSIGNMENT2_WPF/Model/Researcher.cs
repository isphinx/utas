using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Collections.ObjectModel;

namespace KIT506_ASSIGNMENT2_WPF
{
    public enum RESEARCHER_TYPE { Staff, Student }
    public enum CAMPUS { Hobart, Launceston, Cradle_Coast }
    class Researcher
    {
        // | id            | int(11)                                    | NO   | PRI | NULL    |       |
        // | type          | enum('Staff','Student')                    | NO   |     | NULL    |       |
        // | given_name    | varchar(20)                                | NO   |     | NULL    |       |
        // | family_name   | varchar(20)                                | NO   |     | NULL    |       |
        // | title         | varchar(10)                                | NO   |     | NULL    |       |
        // | unit          | varchar(64)                                | NO   |     | NULL    |       |
        // | campus        | enum('Hobart','Launceston','Cradle Coast') | NO   |     | NULL    |       |
        // | email         | varchar(50)                                | YES  |     | NULL    |       |
        // | photo         | varchar(512)                               | YES  |     | NULL    |       |
        // | degree        | varchar(16)                                | YES  |     | NULL    |       |
        // | supervisor_id | int(11)                                    | YES  | MUL | NULL    |       |
        // | level         | enum('A','B','C','D','E')                  | YES  |     | NULL    |       |
        // | utas_start    | date                                       | YES  |     | NULL    |       |
        // | current_start | date                                       | YES  |     | NULL    |       |
        public static Dictionary<LEVEL, double> EXPECTED_PUBLICATION =
        new Dictionary<LEVEL, double> {
            { LEVEL.STUDENT_ONLY, 0.0},
            { LEVEL.A, 0.5},
            { LEVEL.B, 1.0},
            { LEVEL.C, 2.0},
            { LEVEL.D, 3.2},
            { LEVEL.E, 4.0},
        };

        public int ID { get; set; }
        public RESEARCHER_TYPE Type { get; set; }
        public string GivenName { get; set; }
        public string FamilyName { get; set; }
        public string Title { get; set; }
        public string Unit { get; set; }
        public CAMPUS Campus { get; set; }
        public string Email { get; set; }
        public string Photo { get; set; }
        // public string Degree { get; set; }
        public int SupervisorID { get; set; }
        public LEVEL Level { get; set; }
        public DateTime UtasStart { get; set; }
        public DateTime CurrentStart { get; set; }
        public string JobTitle { get; set; }
        public int CumulativeCount { get; set; }
        public int SupervisorCount { get; set; }
        public string SupervisorGivenName { get; set; }
        public string SupervisorFamilyName { get; set; }
        public double Tenure { get; set; }
        public double ThreeYearAve { get; set; }
        public double Performance { get; set; }
        public ObservableCollection<Publication> Publications { get; set; }
        // public ObservableCollection<Position> positions { get; set; }
        public ObservableCollection<Supervision> Supervisions { get; set; }
    }
}
