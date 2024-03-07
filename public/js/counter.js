    const dateSections = document.querySelectorAll('.dateSections');

function formattedDateDifference(inputDate) {
    // Parse the input date string
    const inputDateTime = new Date(inputDate);

    // Get the current date and time
    const currentDate = new Date();

    // Calculate the time difference in milliseconds
    const timeDifference = currentDate - inputDateTime;

    // Convert milliseconds to seconds, minutes, hours, and days
    const seconds = Math.floor(timeDifference / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    // Calculate remaining hours, minutes, and seconds
    const remainingHours = hours % 24;
    const remainingMinutes = minutes % 60;
    const remainingSeconds = seconds % 60;

    // Format the result
    return `${days} Days    ${remainingHours} Hours${remainingMinutes} Minutes${remainingSeconds} Seconds`;
}
let i = 0;

let dateArray = [];

for(; dateSections.length > i; i++) {
    dateArray.push(dateSections[i].innerText)
}

function keepDateUpdated() {
    i = 0;
    dateSections.forEach((dateSection) => {
        dateSection.innerText = formattedDateDifference(dateArray[i]);
        i++;
    })
}

keepDateUpdated()

setInterval(keepDateUpdated, 1000);

