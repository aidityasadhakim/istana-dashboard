/**
 * Dashboard Analytics
 */

// 'use strict';
$(document).ready(function () {
    const totalRevenueChart = document.getElementById("totalRevenueChart");
    // console.log(totalRevenueChart);
});

// logJSONData();

$(function () {
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

    if (active != "custom") {
        async function totalTransactions() {
            const response = await fetch(
                `http://127.0.0.1:8000/api/profit/${active}`
            );
            const data = await response.json();
            $("#profit").text(
                "Rp." +
                    parseFloat(data.data["TotalProfit"]).toLocaleString("id")
            );
        }

        async function cashTransactions() {
            const response = await fetch(
                `http://127.0.0.1:8000/api/cash/${active}`
            );
            const data = await response.json();
            $("#cash").text(
                "Rp." +
                    parseFloat(data.data["TotalProfit"]).toLocaleString("id")
            );
        }

        async function cardTransactions() {
            const response = await fetch(
                `http://127.0.0.1:8000/api/card/${active}`
            );
            const data = await response.json();
            $("#card").text(
                "Rp." +
                    parseFloat(data.data["TotalProfit"]).toLocaleString("id")
            );
        }

        async function totalOrders() {
            const response = await fetch(
                `http://127.0.0.1:8000/api/order/${active}`
            );
            const data = await response.json();
            $("#order").text(
                parseFloat(data.data["TotalOrder"]).toLocaleString("id")
            );
        }

        totalTransactions();
        cashTransactions();
        cardTransactions();
        totalOrders();
    }

    $("#submit").click(function (event) {
        $("#profit").text("Loading");
        $("#cash").text("Loading");
        $("#card").text("Loading");

        $("#thisMonthBtn").removeClass("btn-primary text-white");
        $("#lastMonthBtn").removeClass("btn-primary text-white");
        $("#thisWeekBtn").removeClass("btn-primary text-white");
        $("#todayBtn").removeClass("btn-primary text-white");

        $("#thisMonthBtn").addClass("btn-outline-primary text-primary");
        $("#lastMonthBtn").addClass("btn-outline-primary text-primary");
        $("#thisWeekBtn").addClass("btn-outline-primary text-primary");
        $("#todayBtn").addClass("btn-outline-primary text-primary");

        $("#customDate").addClass("bg-info");

        function totalTransactions() {
            return $.ajax({
                url: `http://127.0.0.1:8000/api/profit/custom`,
                method: "post",
                data: {
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                },
                dataType: "json",
                success: function (data) {
                    $("#profit").text(
                        "Rp." +
                            parseFloat(data.data["TotalProfit"]).toLocaleString(
                                "id"
                            )
                    );
                },
            });
        }

        function cashTransactions() {
            return $.ajax({
                url: `http://127.0.0.1:8000/api/cash/custom`,
                method: "post",
                data: {
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                },
                dataType: "json",
                success: function (data) {
                    $("#cash").text(
                        "Rp." +
                            parseFloat(data.data["TotalProfit"]).toLocaleString(
                                "id"
                            )
                    );
                },
            });
        }

        function cardTransactions() {
            return $.ajax({
                url: `http://127.0.0.1:8000/api/card/custom`,
                method: "post",
                data: {
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                },
                dataType: "json",
                success: function (data) {
                    $("#card").text(
                        "Rp." +
                            parseFloat(data.data["TotalProfit"]).toLocaleString(
                                "id"
                            )
                    );
                },
            });
        }

        function totalOrders() {
            return $.ajax({
                url: `http://127.0.0.1:8000/api/order/custom`,
                method: "post",
                data: {
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                },
                dataType: "json",
                success: function (data) {
                    $("#order").text(
                        "Rp." +
                            parseFloat(data.data["TotalOrder"]).toLocaleString(
                                "id"
                            )
                    );
                },
            });
        }

        Promise.all([
            totalTransactions(),
            cashTransactions(),
            cardTransactions(),
            totalOrders(),
        ]).then(function ($data) {});
    });
});

$(document).ready(function () {
    let cardColor, headingColor, axisColor, shadeColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    // Total Revenue Report Chart - Bar Chart
    // --------------------------------------------------------------------
    const totalRevenueChartEl = document.querySelector("#totalRevenueChart"),
        totalRevenueChartOptions = {
            series: [
                {
                    name: "2021",
                    data: [18, 7, 15, 29, 18, 12, 9],
                },
                {
                    name: "2020",
                    data: [-13, -18, -9, -14, -5, -17, -15],
                },
            ],
            chart: {
                height: 300,
                stacked: true,
                type: "bar",
                toolbar: { show: false },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "33%",
                    borderRadius: 12,
                    startingShape: "rounded",
                    endingShape: "rounded",
                },
            },
            colors: [config.colors.primary, config.colors.info],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
                width: 6,
                lineCap: "round",
                colors: [cardColor],
            },
            legend: {
                show: true,
                horizontalAlign: "left",
                position: "top",
                markers: {
                    height: 8,
                    width: 8,
                    radius: 12,
                    offsetX: -3,
                },
                labels: {
                    colors: axisColor,
                },
                itemMargin: {
                    horizontal: 10,
                },
            },
            grid: {
                borderColor: borderColor,
                padding: {
                    top: 0,
                    bottom: -8,
                    left: 20,
                    right: 20,
                },
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                labels: {
                    style: {
                        fontSize: "13px",
                        colors: axisColor,
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: "13px",
                        colors: axisColor,
                    },
                },
            },
            responsive: [
                {
                    breakpoint: 1700,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "32%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1580,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "35%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1440,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "42%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1300,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "48%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1200,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "40%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 1040,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 11,
                                columnWidth: "48%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 991,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "30%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 840,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "35%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 768,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "28%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 640,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "32%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "37%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 480,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "45%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 420,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "52%",
                            },
                        },
                    },
                },
                {
                    breakpoint: 380,
                    options: {
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                columnWidth: "60%",
                            },
                        },
                    },
                },
            ],
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
    // console.log(totalRevenueChartEl);
    if (
        typeof totalRevenueChartEl !== undefined &&
        totalRevenueChartEl !== null
    ) {
        const totalRevenueChart = new ApexCharts(
            totalRevenueChartEl,
            totalRevenueChartOptions
        );
        totalRevenueChart.render();
    }

    // Growth Chart - Radial Bar Chart
    // --------------------------------------------------------------------
    const growthChartEl = document.querySelector("#growthChart"),
        growthChartOptions = {
            series: [78],
            labels: ["Growth"],
            chart: {
                height: 240,
                type: "radialBar",
            },
            plotOptions: {
                radialBar: {
                    size: 150,
                    offsetY: 10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: "55%",
                    },
                    track: {
                        background: cardColor,
                        strokeWidth: "100%",
                    },
                    dataLabels: {
                        name: {
                            offsetY: 15,
                            color: headingColor,
                            fontSize: "15px",
                            fontWeight: "600",
                            fontFamily: "Public Sans",
                        },
                        value: {
                            offsetY: -25,
                            color: headingColor,
                            fontSize: "22px",
                            fontWeight: "500",
                            fontFamily: "Public Sans",
                        },
                    },
                },
            },
            colors: [config.colors.primary],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    shadeIntensity: 0.5,
                    gradientToColors: [config.colors.primary],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 0.6,
                    stops: [30, 70, 100],
                },
            },
            stroke: {
                dashArray: 5,
            },
            grid: {
                padding: {
                    top: -35,
                    bottom: -10,
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
    if (typeof growthChartEl !== undefined && growthChartEl !== null) {
        const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
        growthChart.render();
    }

    // Profit Report Line Chart
    // --------------------------------------------------------------------
    const profileReportChartEl = document.querySelector("#profileReportChart"),
        profileReportChartConfig = {
            chart: {
                height: 80,
                // width: 175,
                type: "line",
                toolbar: {
                    show: false,
                },
                dropShadow: {
                    enabled: true,
                    top: 10,
                    left: 5,
                    blur: 3,
                    color: config.colors.warning,
                    opacity: 0.15,
                },
                sparkline: {
                    enabled: true,
                },
            },
            grid: {
                show: false,
                padding: {
                    right: 8,
                },
            },
            colors: [config.colors.warning],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 5,
                curve: "smooth",
            },
            series: [
                {
                    data: [110, 270, 145, 245, 205, 285],
                },
            ],
            xaxis: {
                show: false,
                lines: {
                    show: false,
                },
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        };
    if (
        typeof profileReportChartEl !== undefined &&
        profileReportChartEl !== null
    ) {
        const profileReportChart = new ApexCharts(
            profileReportChartEl,
            profileReportChartConfig
        );
        profileReportChart.render();
    }
});