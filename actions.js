const baseURL = './api'
const useURLExtension = location.hostname === 'localhost' || location.hostname === '127.0.0.1' ? '.php' : ''

const redirect = endpoint_destination => {
  window.location = `${endpoint_destination}${endpoint_destination == '/' ? '' : useURLExtension}`
}

let notes = []

const loadNotes = () => {
  if(window.location.toString().startsWith('http://localhost')) {
    for(let id = 0; id < 15; id++) {
      notes.push({
        id,
        text: 'Ini adalah contoh sample note'
      })
    }

    rerenderNotes()

    return
  }

  rerenderLoader(true)

  fetch(
    `${baseURL}/notes/get-notes${useURLExtension}?owner_id=${localStorage.getItem('id')}`
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      notes = resJSON['data']

      rerenderNotes()
    } else {
      console.error(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    console.error(err.toString())
  })
}

const createNewNote = () => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/notes/create-new-note${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        owner_id: localStorage.getItem('id')
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      notes = resJSON['data']

      rerenderNotes()
    } else {
      console.error(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    console.error(err.toString())
  })
}

const deleteButton = id => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/notes/delete-note${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        owner_id: localStorage.getItem('id'),
        id
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      notes = resJSON['data']

      rerenderNotes()
    } else {
      console.error(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)
    
    console.log(err.toString())
  })

  rerenderNotes()
}

const rerenderNotes = () => {
  document.getElementById("notes-list").innerHTML = ''
  
  for(const note of notes) {
    document.getElementById("notes-list").innerHTML += `
      <div
        class="note-container"
      >
        <textarea
          class="note"
          rows="7"
          id="note-${note.id}"
          placeholder="Insert note..."
        >${note.text}</textarea>

        <a
          class="delete-button"
          href="#"
          onclick="deleteButton('${note.id}')"
        >
          X
        </a>
      </div>
    `
  }

  for(const note of notes) {
    const input = document.getElementById(`note-${note.id}`)
  
    input.addEventListener('input', event => {
      note.text = event.target.value
      
      fetch(
        `${baseURL}/notes/edit-note${useURLExtension}`,
        {
          method: 'POST',
          body: JSON.stringify({
            owner_id: localStorage.getItem('id'),
            id: note.id,
            text: event.target.value
          })
        }
      )
      .then(res => res.text())
      .then(resText => {})
      .catch(err => console.log(err.toString()))
    })
  }
}

const rerenderLoader = (isLoading) => {
  document.getElementById('loader-container').innerHTML = isLoading ?
    `<div class="loader-background">
        <div class="loader"></div>
    </div>`
    :
    ``
}

const login = (username, password) => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/session/login${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        username,
        password
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      if(resJSON['api_status'] == 1) {
        localStorage.setItem('id', parseInt(resJSON['data']['id']))
  
        redirect(`/`)
      } else {
        alert(resJSON['api_message'])
      }
    } else {
      alert(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    alert(err.toString())
  })
}

const register = (username, password, confirm_password) => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/session/register${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        username,
        password,
        confirm_password
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      if(resJSON['api_status'] == 1) {
        redirect(`/login`)
      }

      alert(resJSON['api_message'])
    } else {
      alert(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    alert(err.toString())
  })
}

const logout = () => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/session/logout${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        id: localStorage.getItem('id')
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      if(resJSON['api_status'] == 1) {
        localStorage.removeItem('id')

        redirect(`/login`)
      } else {
        alert(resJSON['api_message'])
      }
    } else {
      alert(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    alert(err.toString())
  })
}

const deleteAccount = (username, password, confirm_password) => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/session/delete-account${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        username,
        password,
        confirm_password
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      alert(resJSON['api_message'])

      if(resJSON['api_status'] == 1) {
        localStorage.removeItem('id')

        redirect(`/login`)
      }
    } else {
      alert(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    alert(err.toString())
  })
}