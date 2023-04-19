$(document).ready(function () {
    ("use-strict");

    let cardColor, headingColor, axisColor, shadeColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return "thismonth"; //not found
    }

    let active = getQueryVariable("active");

    async function test(active = "thismonth") {
        const response = await fetch(
            `http://127.0.0.1:8000/api/salestransaction/${active}`
        );
        const data = await response.json();
    }

    function chartTrigger(
        type = "",
        start_date = "",
        end_date = "",
        custom = false
    ) {
        async function totalTransactions() {
            let series1 = "",
                series2 = "",
                customCat = "";

            if (active != "custom" && !custom) {
                const response = await fetch(
                    `http://127.0.0.1:8000/api/salestransaction/${active}`
                );
                const data = await response.json();

                const response2 = await fetch(
                    `http://127.0.0.1:8000/api/servicestransaction/${active}`
                );
                const data2 = await response2.json();

                if (type == "transactions") {
                    series1 = data.data.totalTransaction;
                    series2 = data2.data.totalTransaction;
                } else if (type == "order") {
                    series1 = data.data.totalCash;
                    series2 = data2.data.totalCash;
                } else {
                    incomeChart();
                }
            } else {
                const response = await fetch(
                    `http://127.0.0.1:8000/api/salestransaction/custom`,
                    {
                        method: "POST",
                        body: JSON.stringify({
                            start_date: start_date,
                            end_date: end_date,
                        }),
                    }
                );
                const data = await response.json();

                const response2 = await fetch(
                    `http://127.0.0.1:8000/api/servicestransaction/custom`,
                    {
                        method: "POST",
                        body: JSON.stringify({
                            start_date: start_date,
                            end_date: end_date,
                        }),
                    }
                );
                const data2 = await response2.json();

                console.log(start_date, end_date);
                console.log(data);

                if (type == "transactions") {
                    series1 = data.data.totalTransaction;
                    series2 = data2.data.totalTransaction;
                    customCat = data.data.date;
                } else if (type == "order") {
                    series1 = data.data.totalCash;
                    series2 = data2.data.totalCash;
                    customCat = data.data.date;
                } else {
                    incomeChart();
                }
            }
            incomeChart(active, series1, series2, customCat);
        }
        totalTransactions();
    }

    function incomeChart(
        active = "",
        series1 = [],
        series2 = [],
        customCat = ""
    ) {
        console.log(active, series1, series2, customCat);

        const todayDate = getTodayDate();
        const firstDateThisMonth = getFirstDateThisMonth();
        const lastDateThisMonth = getLastDateThisMonth();

        let masterLabels = {
            today: [todayDate],
            thismonth: Array(Number(lastDateThisMonth))
                .join()
                .split(",")
                .map(
                    function (a) {
                        return this.i++;
                    },
                    { i: 1 }
                ),
            lastmonth: Array(Number(lastDateThisMonth))
                .join()
                .split(",")
                .map(
                    function (a) {
                        return this.i++;
                    },
                    { i: 1 }
                ),
            thisweek: ["Mon", "Tue", "Thu", "Wed", "Fri", "Sat", "Sun"],
            custom: customCat,
        };

        const maxSeries1 = series1.reduce((a, b) => Math.max(a, b), -Infinity);
        const maxSeries2 = series2.reduce((a, b) => Math.max(a, b), -Infinity);
        const maxNum = maxSeries1 > maxSeries2 ? maxSeries1 : maxSeries2;

        // Income Chart - Area chart
        // --------------------------------------------------------------------
        const incomeChartEl = document.querySelector("#incomeChart"),
            incomeChartConfig = {
                series: [
                    {
                        name: "Sales",
                        data: series1,
                    },
                    {
                        name: "Services",
                        data: series2,
                    },
                ],
                chart: {
                    height: 215,
                    parentHeightOffset: 0,
                    parentWidthOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    type: "area",
                },
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    width: 3,
                    curve: "smooth",
                },
                legend: {
                    show: true,
                },
                markers: {
                    size: 6,
                    colors: "transparent",
                    strokeColors: "transparent",
                    strokeWidth: 4,
                    discrete: [
                        {
                            fillColor: config.colors.white,
                            seriesIndex: 0,
                            dataPointIndex: 7,
                            strokeColor: config.colors.primary,
                            strokeWidth: 2,
                            size: 6,
                            radius: 8,
                        },
                    ],
                    hover: {
                        size: 7,
                    },
                },
                colors: [config.colors.primary, config.colors.success],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: shadeColor,
                        shadeIntensity: 0.6,
                        opacityFrom: 0.5,
                        opacityTo: 0.25,
                        stops: [0, 95, 100],
                    },
                },
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 3,
                    padding: {
                        top: -20,
                        bottom: -8,
                        left: -10,
                        right: 8,
                    },
                },
                xaxis: {
                    categories: masterLabels[active],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: true,
                        style: {
                            fontSize: "13px",
                            colors: axisColor,
                        },
                    },
                },
                yaxis: {
                    labels: {
                        show: false,
                    },
                    min: 0,
                    max: maxNum,
                    tickAmount: 4,
                },
            };
        while (incomeChartEl.firstChild) {
            incomeChartEl.removeChild(incomeChartEl.lastChild);
        }

        if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
            const incomeChart = new ApexCharts(
                incomeChartEl,
                incomeChartConfig
            );
            incomeChart.render();
        }
    }

    // Expenses Mini Chart - Radial Chart
    // --------------------------------------------------------------------
    const weeklyExpensesEl = document.querySelector("#expensesOfWeek"),
        weeklyExpensesConfig = {
            series: [65],
            chart: {
                width: 60,
                height: 60,
                type: "radialBar",
            },
            plotOptions: {
                radialBar: {
                    startAngle: 0,
                    endAngle: 360,
                    strokeWidth: "8",
                    hollow: {
                        margin: 2,
                        size: "45%",
                    },
                    track: {
                        strokeWidth: "50%",
                        background: borderColor,
                    },
                    dataLabels: {
                        show: true,
                        name: {
                            show: false,
                        },
                        value: {
                            formatter: function (val) {
                                return "$" + parseInt(val);
                            },
                            offsetY: 5,
                            color: "#697a8d",
                            fontSize: "13px",
                            show: true,
                        },
                    },
                },
            },
            fill: {
                type: "solid",
                colors: config.colors.primary,
            },
            stroke: {
                lineCap: "round",
            },
            grid: {
                padding: {
                    top: -10,
                    bottom: -15,
                    left: -10,
                    right: -10,
                },
            },
            states: {
                hover: {
                    filter: {
                        type: "none",
                    },
                },
                active: {
                    filter: {
                        type: "none",
                    },
                },
            },
        };
    if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
        const weeklyExpenses = new ApexCharts(
            weeklyExpensesEl,
            weeklyExpensesConfig
        );
        weeklyExpenses.render();
    }

    chartTrigger("transactions");

    $("#button-transactions").on("click", function () {
        $("#button-order").removeClass("active");

        $("#button-transactions").addClass("active");

        chartTrigger("transactions");
    });

    $("#button-order").on("click", function () {
        $("#button-transactions").removeClass("active");

        $("#button-order").addClass("active");

        if (active == "custom") {
            chartTrigger(
                "order",
                $("#start_date").val(),
                $("#end_date").val(),
                true
            );
        } else {
            chartTrigger("order");
        }
    });

    $("#submit").click(function (event) {
        active = "custom";
        chartTrigger(
            "transactions",
            $("#start_date").val(),
            $("#end_date").val(),
            true
        );
    });
});
