using System.Collections.ObjectModel;

namespace KIT506_ASSIGNMENT2_WPF.Model
{
    class Stuff : Researcher
    {
        public ObservableCollection<Position> Positions { get; set; }
    }
}
