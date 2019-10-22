using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Collections.ObjectModel;

namespace KIT506_ASSIGNMENT2_WPF.Controller
{
    class PublicationController
    {
        private readonly ObservableCollection<Publication> pulications;

        public PublicationController()
        {
            // pulications = Database.GetInstance().GetPublication();
        }
    }
}
