import "../styles/App.css";

import React, { Component } from "react";
import Board from "./Board";
import axios from "axios";
import Cookies from 'universal-cookie';

const cookies = new Cookies();
// cookies.set('isUserLoggedIn', false);

var formState = {
  isUserLoggedIn: false,
  email: "",
  password: "",
  fullname: ""
};

const loginSubmit = (e) => {
  e.preventDefault();
  console.log(formState);
  const email = formState.email;
  const password = formState.password;
  axios.post("http://localhost/trello-clone/index.php?action=login", {
    email,
    password
  }).then(res => {
    if (res.data.status == "success") {
      cookies.set('isUserLoggedIn', true);
      cookies.set('userData', res.data.user);
      
      window.location.href = "/";
    } else {
      alert("Wrong email or password");
    }
  }
  );
}

const signupSubmit = (e) => {
  e.preventDefault();
  console.log(formState);
  const email = formState.email;
  const password = formState.password;
  const fullname = formState.fullname;
  axios.post("http://localhost/trello-clone/index.php?action=signup", {
    email,
    password,
    fullname
  }).then(res => {
    if (res.data.status == "success") {
      cookies.set('isUserLoggedIn', true);
      cookies.set('userData', res.data.user);

      window.location.href = "/";
    } else {
      alert("Wrong email or password");
    }
  }
);
}

const onChange = (e) => {
  formState[e.target.name] = e.target.value;
}

class App extends Component {
  render() {


    var body = {
      firstName: 'testName',
      lastName: 'testLastName'
    };
  
    axios.post('http://localhost/trello-clone/index.php?action=login', body)
    .then(function (response) {
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });

    if ( cookies.get('isUserLoggedIn') !== 'true') {
      cookies.set('isUserLoggedIn', false);
      return (
        <div className="App">
          <div className="Login-Box">
            <h1>My Self Trello App</h1>
            <form className="Login-Form" onSubmit={loginSubmit}>
              <input className="Login-Input" name="email" type="email" placeholder="Enter your email" onChange={onChange}/>
              <input className="Login-Input" name="password" type="password" placeholder="Enter your password" onChange={onChange}/>
              <button className="Login-Submit" name="submit">Login</button>
            </form>
            <span className="my-4">Or</span>
            <form className="Login-Form" onSubmit={signupSubmit}>
              <input className="Login-Input" name="email" type="email" placeholder="Enter your email" onChange={onChange}/>
              <input className="Login-Input" name="password" type="password" placeholder="Enter your password" onChange={onChange}/>
              <input className="Login-Input" name="fullname" type="name" placeholder="Enter your Fullname" onChange={onChange}/>
              <button className="Login-Submit" name="submit">Signup</button>
            </form>
          </div>
        </div>
      );
    }

    const username = cookies.get('userData') ? cookies.get('userData').user_fullname : "";

    return (
      <div className="App">
        <div className="Header">
          User: {username}
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
