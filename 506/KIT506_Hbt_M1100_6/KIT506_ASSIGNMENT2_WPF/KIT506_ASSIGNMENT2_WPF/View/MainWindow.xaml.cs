using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Drawing.Imaging;
using System.Collections.ObjectModel;

namespace KIT506_ASSIGNMENT2_WPF
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        private readonly Controller.ResearcherController researcherController;
        private readonly Controller.PublicationController publicationController;

        public MainWindow()
        {
            InitializeComponent();

            researcherController = new Controller.ResearcherController();
            publicationController = new Controller.PublicationController();

            this.researcherListBox.ItemsSource = researcherController.Researchers;
            // this.researcherListBox.DisplayMemberPath = "GivenName";
        }

        private void ResearcherListBox_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if ((sender as ListBox).SelectedItem is Researcher r)
            {
                Researcher researcher = researcherController.GetResearcher(r.Type, r.ID);
                researcherDetail.DataContext = researcher;
                publicationTable.ItemsSource = researcher.Publications;

                photo.Source = new BitmapImage(new Uri(researcher.Photo));

                if (researcher is Model.Stuff stuff)
                {
                    previousPositions.ItemsSource = stuff.Positions;
                }
            }
        }

        private void ComboBox_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (researcherController != null)
            {
                LEVEL level = (LEVEL)(sender as ComboBox).SelectedIndex;
                if (level == LEVEL.ALL)
                    this.researcherListBox.ItemsSource = researcherController.Researchers;
                else
                    this.researcherListBox.ItemsSource = researcherController.FilterResearcherbyLevel(level);
            }
        }

        private void TextBox_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.Key == Key.Enter)
            {
                string name = (sender as TextBox).Text;

                var researchers = researcherController.FilterResearcherbyName(name);

                this.researcherListBox.ItemsSource = researchers;
            }
        }

        private void PublicationTable_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if ((sender as DataGrid).SelectedItem is Publication pu)
            {
                publicationDetail.DataContext = pu;
            }
        }

        private void Button_Click(object sender, RoutedEventArgs e)
        {
            if (researcherDetail.DataContext is Researcher researcher)
            {
                MessageBox.Show(researcherController.GetCumulativeCount(researcher));
            }
        }

        private void BtnPublicationSearch_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                var start = int.Parse(yearBegin.Text);
                var end = int.Parse(yearEnd.Text);
                if (researcherDetail.DataContext is Researcher researcher)
                {
                    var publications = from Publication p in researcher.Publications
                                       where int.Parse(p.Year) >= start && int.Parse(p.Year) <= end
                                       select p;

                    var result = new ObservableCollection<Publication>(publications.ToList());
                    publicationTable.ItemsSource = result;
                }
            }
            catch { }
        }

        private void BtnPublicationClear_Click(object sender, RoutedEventArgs e)
        {
            if (researcherDetail.DataContext is Researcher researcher)
            {
                yearBegin.Clear();
                yearEnd.Clear();
                publicationTable.ItemsSource = researcher.Publications.Reverse();
            }
        }
        private void BtnPublicationInvert_Click(object sender, RoutedEventArgs e)
        {
            if (researcherDetail.DataContext is Researcher researcher)
            {
                if (publicationTable.ItemsSource is ObservableCollection<Publication> publications)
                {
                    publicationTable.ItemsSource = new ObservableCollection<Publication>(publications.Reverse().ToList());
                }
            }
        }

        private void Button_Click_3(object sender, RoutedEventArgs e)
        {
            if (researcherDetail.DataContext is Researcher researcher)
            {
                if (researcher.SupervisorCount == 0)
                {
                    MessageBox.Show("no supervisions");
                }
                else
                {
                    var result = researcherController.GetSupervisionNames(researcher.Supervisions);
                    MessageBox.Show(result);
                }
            }
        }

        private void BtnReport_Click(object sender, RoutedEventArgs e)
        {
            if (btnReport.Content.ToString() == "Show Report")
            {
                btnReport.Content = "Hide Report";
                listReport.Visibility = Visibility.Visible;
                lbReport.Visibility = Visibility.Visible;
                btnCopyEmail.Visibility = Visibility.Visible;
            }
            else
            {
                btnReport.Content = "Show Report";
                listReport.Visibility = Visibility.Hidden;
                lbReport.Visibility = Visibility.Hidden;
                btnCopyEmail.Visibility = Visibility.Hidden;
            }
        }

        private void ListReport_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (sender is ListBox listbox)
            {
                lbReport.ItemsSource = researcherController.GetPerformance(listbox.SelectedIndex);
                lbReport.Visibility = Visibility.Visible;
            }
        }

        private void btnCopyEmail_Click(object sender, RoutedEventArgs e)
        {
            if (lbReport.SelectedIndex >= 0 && lbReport.SelectedIndex >= 0)
            {
                var performances = researcherController.GetPerformance(listReport.SelectedIndex);
                var performance = performances[lbReport.SelectedIndex];
                var email = performance.Email;
                Clipboard.SetText(email);
                MessageBox.Show("Successfully copy email:" + email + " to clipboard!");
            }
            else
            {
                MessageBox.Show("Please select a performance!");
            }
        }
    }
}
