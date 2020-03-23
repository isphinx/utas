//
//  ContentView.swift
//  tutorial4_swiftui
//
//  Created by lucas lee on 22/3/20.
//  Copyright © 2020 lucas lee. All rights reserved.
//

import SwiftUI

struct ContentView: View {
    @State var textName = ""
    @State var showDetail = false
    @State var tag : Int? = nil
    
    var body: some View {
        NavigationView {
            VStack {
                Text("Hello, World!")
                
                TextField("enter your name", text: $textName)

                // Button("continue", action: {
                //     DispatchQueue.main.asyncAfter(deadline: .now() + 0.1) {
                //         self.showDetail = true
                //         print("toggle show second!")
                //     }
                // })
                Button("continue", action: { self.tag = 1 })

                //MARK: - NAVIGATION LINKS
                // NavigationLink(destination: SecondView(), isActive: $showDetail) {
                //     EmptyView()
                // }
                NavigationLink(
                    destination: SecondView(tag: $tag, textName: $textName),
                    tag: 1, selection: $tag) {
                    EmptyView()
                }
            }
        }

        // Button(action: {
        //     self.showDetail.toggle()
        // }) {
        //     Text("Show Detail")
        // }.sheet(isPresented: $showDetail) {
        //     SecondView()
        // }
    }
}

struct SecondView: View {
    @Binding var tag: Int?
    @Binding var textName: String
    
    var body: some View {

        VStack {
            Text("this is a name you entered")
            // Text(verbatim: $self.textName)
            TextField("", text: $textName)
        }
       
    }
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        ContentView()
    }
}


