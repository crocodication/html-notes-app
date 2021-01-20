<!DOCTYPE html>

<html>
  <head>
    <title>
      Notes App
    </title>

    <link rel="stylesheet" href="./styles.css">

    <script src="./actions.js"></script>

    <script>
      let username = '', password = ''

      const id = localStorage.getItem('id')

      if(id != undefined) {
        redirect(`/`)
      }

      window.onload = () => {
        document.getElementById(`username-input`).addEventListener('input', event => username = event.target.value)
        document.getElementById(`password-input`).addEventListener('input', event => password = event.target.value)
      }
    </script>
  </head>

  <body>
    <div
      class="non-session-page-container"
    >
      <p
        class="title"
      >
        Welcome To Notes App
      </p>

      <div
        class="content-container"
      >
        <input
          class="non-session-input"
          id="username-input"
          placeholder="Username"
        >

        <input
          class="non-session-input"
          id="password-input"
          placeholder="Password"
          type="password"
        >
      </div>

      <div
        class="bottom-options-container"
      >
        <a
          class="bottom-option"
          href="#"
          onclick="login(username, password)"
        >
          Login
        </a>

        <a
          class="bottom-option"
          href="#"
          onclick="redirect('/register')"
        >
          Register
        </a>
      </div>
    </div>

    <div
      class="loader-container"
      id="loader-container"
    >
    </div>
  </body>
</html>