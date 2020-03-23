//
//  MovieUITableViewController.swift
//  Tutorial5
//
//  Created by lucas lee on 23/3/20.
//  Copyright © 2020 Lindsay Wells. All rights reserved.
//

import UIKit

class MovieUITableViewController: UITableViewController {
    var movies = [Movie]()

    override func viewDidLoad() {
        super.viewDidLoad()
        
        let  database : SQLiteDatabase = SQLiteDatabase(databaseName: "MyDatabase")
        print(database.selectMovieBy(id:   1) ??  "Movie not found")
        
        //database.insert(movie:Movie(name:"Lord of the Rings", year:2003, director:"Peter Jackson"))
        //database.insert(movie:Movie(name:"The Matrix", year:1999, director:"Lana Wachowski, Lilly Wachowski"))
        movies = database.selectAllMovies()

        // Uncomment the following line to preserve selection between presentations
        // self.clearsSelectionOnViewWillAppear = false

        // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
        // self.navigationItem.rightBarButtonItem = self.editButtonItem
    }

    // MARK: - Table view data source

    override func numberOfSections(in tableView: UITableView) -> Int {
        // #warning Incomplete implementation, return the number of sections
        return 1
    }

    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // #warning Incomplete implementation, return the number of rows
        return movies.count
    }

    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //et cell = tableView.dequeueReusableCell(withIdentifier: "reuseIdentifier", for: indexPath)
        let cell = tableView.dequeueReusableCell(withIdentifier: "MovieUITableViewCell", for: indexPath)
        // Configure the cell...

        let movie = movies[indexPath.row]
        if let movieCell = cell as? MovieUITableViewCell
        {
            movieCell.titleLabel.text    = movie.name
            movieCell.subTitleLabel.text = String(movie.year)
        }
        return cell
    }
    

    /*
    // Override to support conditional editing of the table view.
    override func tableView(_ tableView: UITableView, canEditRowAt indexPath: IndexPath) -> Bool {
        // Return false if you do not want the specified item to be editable.
        return true
    }
    */

    /*
    // Override to support editing the table view.
    override func tableView(_ tableView: UITableView, commit editingStyle: UITableViewCell.EditingStyle, forRowAt indexPath: IndexPath) {
        if editingStyle == .delete {
            // Delete the row from the data source
            tableView.deleteRows(at: [indexPath], with: .fade)
        } else if editingStyle == .insert {
            // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
        }    
    }
    */

    /*
    // Override to support rearranging the table view.
    override func tableView(_ tableView: UITableView, moveRowAt fromIndexPath: IndexPath, to: IndexPath) {

    }
    */

    /*
    // Override to support conditional rearranging of the table view.
    override func tableView(_ tableView: UITableView, canMoveRowAt indexPath: IndexPath) -> Bool {
        // Return false if you do not want the item to be re-orderable.
        return true
    }
    */

    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func   prepare(for segue: UIStoryboardSegue, sender: Any?)
    {
        super.prepare(for: segue, sender: sender)
        if segue.identifier == "ShowMovieDetailSegue"
        {
            guard let   detailViewController = segue.destination as? DetailViewController else
            {
                fatalError("Unexpected destination: \(segue.destination)")
            }
            guard let   selectedMovieCell = sender as? MovieUITableViewCell else
            {
                fatalError("Unexpected sender: \( String(describing: sender))")
            }
            guard let   indexPath = tableView.indexPath(for: selectedMovieCell) else
            {
                fatalError("The selected cell is not being displayed by the table")
            }
            let   selectedMovie = movies[indexPath.row ]
            detailViewController.movie = selectedMovie
        }
    }

}
