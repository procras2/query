// vim: set sw=4 ts=4 expandtab nu:
const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

// navbar toggle button
toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})

