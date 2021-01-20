<!DOCTYPE html>

<html>
  <head>
    <title>
      Notes App
    </title>

    <link rel="stylesheet" href="./styles.css">

    <script src="./actions.js"></script>

    <script>
      const id = localStorage.getItem('id')

      if(id != undefined) {
        redirect(`/`)
      }

      let username = '', password = ''
      
      const submitRegister = () => {
        register(username, password)
      }
      
      window.onload = () => {
        document.getElementById(`username-input`).addEventListener('input', event => username = event.target.value)
        document.getElementById(`password-input`).addEventListener('input', event => password = event.target.value)
      }
    </script>
  </head>

  <body>
    <form
      class="non-session-page-container"
    >
      <p
        class="title"
      >
        Register To Notes App
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
          onclick="submitRegister()"
        >
          Submit
        </a>
      </div>
    </form>

    <div
      class="loader-container"
      id="loader-container"
    >
    </div>
  </body>
</html>