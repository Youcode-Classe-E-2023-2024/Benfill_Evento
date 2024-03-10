const eventRequestSection = document.getElementById('event-request-list')
const eventListSection = document.getElementById('event-list')
const eventRequestBtn = document.getElementById('event-request-btn')
const eventListBtn = document.getElementById('event-list-btn')

eventRequestBtn.addEventListener('click', () => {
    eventRequestSection.classList.remove('hidden')
    eventRequestBtn.classList.add('hidden')
    eventListBtn.classList.remove('hidden')
    eventListSection.classList.add('hidden')
})


eventListBtn.addEventListener('click', () => {
    eventRequestSection.classList.add('hidden')
    eventRequestBtn.classList.remove('hidden')
    eventListBtn.classList.add('hidden')
    eventListSection.classList.remove('hidden')
})
