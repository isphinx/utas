using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace KIT506_ASSIGNMENT2_WPF
{
    public enum LEVEL { ALL, STUDENT_ONLY, A, B, C, D, E }
    class Position
    {
        // id    | int (11)                  | NO   | PRI | NULL    |       |
        // level | enum('A','B','C','D','E') | NO   | PRI | NULL    |       |
        // start | date                      | NO   | PRI | NULL    |       |
        // end   | date
        public int ID { get; set; }
        public LEVEL Level { get; set; }
        public DateTime Start { get; set; }
        public DateTime End { get; set; }
        public string JobTitle { get; set; }
    }
}
