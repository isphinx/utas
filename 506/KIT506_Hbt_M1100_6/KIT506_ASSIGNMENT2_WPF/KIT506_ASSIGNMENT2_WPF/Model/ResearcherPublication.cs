using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace KIT506_ASSIGNMENT2_WPF
{
    // | researcher_id | int(11)      | NO   | PRI | NULL    |       |
    // | doi           | varchar(256) | NO   | PRI | NULL    |       |

    class ResearcherPublication
    {
        public int ResearcherID { set; get; }
        public string DOI { set; get; }
    }
}
