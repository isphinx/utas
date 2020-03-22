//
//  ViewController.swift
//  tutorial4
//
//  Created by lucas lee on 22/3/20.
//  Copyright © 2020 lucas lee. All rights reserved.
//

import UIKit

class ViewController: UIViewController {
    @IBOutlet weak var nameField: UITextField!
    @IBAction func continueButton(_ sender: UIButton) {
        print("Hey awesome tutor, check this out.")
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if segue.identifier == "SecondViewControllerSegue"
        {
            print("Second view controller segue called")
            let nextScreen = segue.destination as! SecondViewController
            nextScreen.nameFromPreviousView = nameField.text
        }
    }


}

