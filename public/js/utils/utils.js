var options = {
    month: "short",
    day: "numeric",
};

let todayDate = new Date().toISOString().split("-");
let currentYear = todayDate[0];
let currentMonth = todayDate[1];
todayDate = todayDate[1] + "-" + todayDate[2].split("T")[0];

function getTodayDate() {
    let todayDate = new Date().toISOString().split("-");
    todayDate = todayDate[1] + "-" + todayDate[2].split("T")[0];
    return todayDate;
}

function getFirstDateThisMonth() {
    const todayDate = new Date().toISOString().split("-");
    let currentYear = todayDate[0];
    let currentMonth = todayDate[1];

    let firstDateThisMonth = new Date(currentYear, currentMonth - 1, 2)
        .toISOString()
        .split("T")[0]
        .split("-")[2];

    return firstDateThisMonth;
}

function getLastDateThisMonth() {
    const todayDate = new Date().toISOString().split("-");
    let currentYear = todayDate[0];
    let currentMonth = todayDate[1];

    let lastDateThisMonth = new Date(currentYear, currentMonth - 1, 1)
        .toISOString()
        .split("T")[0]
        .split("-")[2];

    return lastDateThisMonth;
}
