# Dashboard Application

This is a simple dashboard application that is made for Istana HP, this simple dashboard contains the total profit, transaction paid with cash, credit/debit card and the total order that has been made. This dashboard also generates total item sold and the specific type of each item that being sold.

# Installation

Actually, this application is not open for everyone since the database is restricted and owned by Istana HP. So, if you want to use this application, you might need to recreate the database and query.
There is no dependency needed for this application, it uses the default Laravel, JavaScript, HTML and CSS default built in modules. This application also uses framework such as Bootstrap and jQuery.

# Application Preview

![Login Page](/public/assets/img/readme/login.png)

<p style="text-align: center;">Login Page</p>

![Login Page](/public/assets/img/readme/page1.png)

<p style="text-align: center;">Page</p>

![Login Page](/public/assets/img/readme/page2.png)

<p style="text-align: center;">Page</p>

## API

This app doesn't use the Laravel blade so much, it's because I use the Laravel for the API Gateway. So the data is fetched by the JavaScript.

## Routes

### Total Profit

    GET /profit/today
    GET /profit/thismonth
    GET /profit/lastmonth
    GET /profit/thisweek
    POST /profit/custom

### Paid by cash

    GET /cash/today
    GET /cash/thismonth
    GET /cash/lastmonth
    GET /cash/thisweek
    POST /profit/custom

### Paid by Credit/Debit Card

    GET /card/today
    GET /card/thismonth
    GET /card/lastmonth
    GET /card/thisweek
    POST /profit/custom

### Total Order

    GET /order/today
    GET /order/thismonth
    GET /order/lastmonth
    GET /order/thisweek
    POST /order/custom

### Sales Transaction

    GET /salestransaction/today
    GET /salestransaction/thismonth
    GET /salestransaction/lastmonth
    GET /salestransaction/thisweek
    POST /salestransaction/custom

### Services Transaction

    POST /servicestransaction/custom
    GET /servicestransaction/today
    GET /servicestransaction/thismonth
    GET /servicestransaction/lastmonth
    GET /servicestransaction/thisweek

### Item Type

    POST /itemtype/custom
    GET /itemtype/today
    GET /itemtype/thismonth
    GET /itemtype/lastmonth
    GET /itemtype/thisweek

# Update

This application surely still need a lot of feature going on.
