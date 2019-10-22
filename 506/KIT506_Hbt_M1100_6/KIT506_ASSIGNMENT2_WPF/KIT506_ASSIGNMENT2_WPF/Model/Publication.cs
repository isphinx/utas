using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace KIT506_ASSIGNMENT2_WPF
{
    public enum PUBLICATIONS_TYPE { Conference, Journal, Other };
    class Publication
    {
        // | doi       | varchar(256)                         | NO   | PRI | NULL    |       |
        // | title     | varchar(256)                         | NO   |     | NULL    |       |
        // | authors   | varchar(256)                         | NO   |     | NULL    |       |
        // | year      | year(4)                              | NO   |     | NULL    |       |
        // | type      | enum('Conference','Journal','Other') | NO   |     | NULL    |       |
        // | cite_as   | varchar(1024)                        | NO   |     | NULL    |       |
        // | available | date                                 | NO   |     | NULL    |       |
        public string DOI { get; set; }
        public string Title { get; set; }
        public string Authors { get; set; }
        public string Year { get; set; }
        public PUBLICATIONS_TYPE Type { get; set; }
        public string CiteAS { get; set; }
        public DateTime Available { get; set; }
        public double Age { get; set; }

    }
}
