//
//  ContentView.swift
//  tutorial5_swift
//
//  Created by lucas lee on 23/3/20.
//  Copyright © 2020 lucas lee. All rights reserved.
//

import SwiftUI

struct Movie: Identifiable
{
    var id = UUID()
    var num:Int32 = -1
    var name:String
    var year:Int32
    var director:String
}

struct ContentView: View {
    let movies: [Movie] = [
        Movie(num: 1, name: "Lord of the Rings", year: 2003, director: "Peter Jaskson"),
        Movie(num: 2, name: "The Matrix", year: 1999, director: "Lana Wachowski, Lilly Wachowski")
    ]
    
    var body: some View {
        NavigationView {
            List(movies) { movie in
                NavigationLink(destination: DetailView(
                    name: movie.name,
                    year: movie.year,
                    director: movie.director)) {
                        VStack(alignment: .leading) {
                            Spacer()
                            Text(movie.name).font(.title)
                            Text(String(movie.year)).font(.subheadline)
                        }
                }

            }
        .navigationBarTitle("Movies")
        }
    }
}

struct DetailView: View {
    var name:String
    var year:Int32
    var director:String
    
    var body: some View {
        VStack {
            Text(name).font(.largeTitle)
            Spacer()
            HStack {
                Text("Year Release").font(.title)
                Spacer()
                Text("Director").font(.title)
            }
            Spacer()
                .frame(height: 5.0)
            HStack {
                Text(String(year))
                Spacer()
                Text(director)
            }
        }
        .frame(height: 200.0)
 
    }
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        ContentView()
//        DetailView(name: "Lord of the Rings", year: 2003, director: "Peter Jaskson")
    }
}
