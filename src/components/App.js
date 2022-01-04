import "../styles/App.css";

import React, { Component } from "react";
import Board from "./Board";

class App extends Component {
  render() {
    return (
      <div className="App">
        <div className="Header">
          My Self Trello App
          <p>
            Good morning everyone! Dont’t forget to put your<br></br>daily tasks here
          </p>
        </div>

        <Board />
      </div>
    );
  }
}

export default App;
