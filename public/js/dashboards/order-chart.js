$(document).ready(function () {
    let cardColor, headingColor, axisColor, shadeColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    const loader =
        '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';

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

    function chartOrderTrigger(start_date = "", end_date = "") {
        async function totalTransactions() {
            let series1 = "";

            if (active != "custom") {
                $("#total-items").html(loader);
                const response = await fetch(
                    config.baseurl + `/api/itemtype/${active}`
                );
                const data = await response.json();

                series1 = data.data;
            } else {
                const response = await fetch(
                    config.baseurl + `/api/itemtype/custom`,
                    {
                        method: "POST",
                        body: JSON.stringify({
                            start_date: start_date,
                            end_date: end_date,
                        }),
                    }
                );
                const data = await response.json();

                series1 = data.data;
            }

            chartOrder(series1);
        }
        totalTransactions();
    }

    function chartOrder(series1) {
        const totalFunction = (series1) =>
            Object.values(series1).reduce((a, b) => a + b, 0);
        total = totalFunction(series1);

        $("#total-items").text(total);
        $("#total-accessories").text(series1.Accessories ?? 0);
        $("#total-part").text(series1.Part ?? 0);
        $("#total-unit").text(series1.Unit ?? 0);
        $("#total-tools").text(series1.Tools ?? 0);

        let masterLabels = {
            thisweek: "Weekly",
            thismonth: "Monthly",
            lastmonth: "Monthly",
            today: "Today",
            custom: "Range",
        };

        // Order Statistics Chart
        // --------------------------------------------------------------------
        const chartOrderStatistics = document.querySelector(
                "#orderStatisticsChart"
            ),
            orderChartConfig = {
                chart: {
                    height: 165,
                    width: 130,
                    type: "donut",
                },
                labels: ["Accessories", "Parts", "Units", "Tools"],
                series: [
                    series1.Accessories ?? 0,
                    series1.Part ?? 0,
                    series1.Unit ?? 0,
                    series1.Tools ?? 0,
                ],
                colors: [
                    config.colors.primary,
                    config.colors.warning,
                    config.colors.info,
                    config.colors.success,
                ],
                stroke: {
                    width: 5,
                    colors: cardColor,
                },
                dataLabels: {
                    enabled: false,
                    formatter: function (val, opt) {
                        return parseInt(val) + "%";
                    },
                },
                legend: {
                    show: false,
                },
                grid: {
                    padding: {
                        top: 0,
                        bottom: 0,
                        right: 15,
                    },
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "60%",
                            labels: {
                                show: true,
                                value: {
                                    fontSize: "1.5rem",
                                    fontFamily: "Public Sans",
                                    color: headingColor,
                                    offsetY: -15,
                                    formatter: function (val) {
                                        return (
                                            parseInt((val / total) * 100) + "%"
                                        );
                                    },
                                },
                                name: {
                                    offsetY: 20,
                                    fontFamily: "Public Sans",
                                },
                                total: {
                                    show: true,
                                    fontSize: "0.8125rem",
                                    color: axisColor,
                                    label: masterLabels[active],
                                },
                            },
                        },
                    },
                },
            };

        while (chartOrderStatistics.firstChild) {
            chartOrderStatistics.removeChild(chartOrderStatistics.lastChild);
        }
        if (
            typeof chartOrderStatistics !== undefined &&
            chartOrderStatistics !== null
        ) {
            const statisticsChart = new ApexCharts(
                chartOrderStatistics,
                orderChartConfig
            );
            statisticsChart.render();
        }
    }
    chartOrderTrigger();

    $("#submit").click(function (event) {
        active = "custom";
        chartOrderTrigger($("#start_date").val(), $("#end_date").val());
    });
});
