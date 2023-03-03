var PMI_REPORT = (function () {
    var _args = {};
    return {
        init: function (args) {
            _args = args;
        },
        loadOverAllTarget: function () {
            loadOverAllTarget(_args.overAllTargetRoute);
        },
        loadTop5TargetAchievementBranch: function () {
            loadTop5TargetAchievementBranch(_args.top5BranchTargetRoute);
        },
        loadTop5TargetAchievementCluster: function () {
            loadTop5TargetAchievementCluster(_args.top5ClusterTargetRoute);
        },
        loadTop5TargetAchievementStaff: function () {
            loadTop5TargetAchievementStaff(_args.top5StaffTargetRoute);
        },
        loadTop5KpaScorer: function () {
            loadTop5KpaScorer(_args.top5KpaScorerRoute);
        },

        loadTop5PaScorer: function () {
            loadTop5PaScorer(_args.top5PaScorerRoute);
        },
        top5DepartmentScorer: function () {
            top5DepartmentScorer(_args.top5DepartmentScorerRoute);
        },

        top5ClusterHeadScorer: function () {
            top5ClusterHeadScorer(_args.top5ClusterHeadScorerRoute);
        },
        recentExamLearningNDevScorer: function () {
            recentExamLearningNDevScorer(_args.topLearningNDevRoute);
        },

        top5LearningNDevScorer: function () {
            top5LearningNDevScorer(_args.top5LearningNDevRoute);
        },
        loadMyBranchTargetAchievementCluster: function () {
            loadMyBranchTargetAchievementCluster(_args.myBranchTargetRoute);
        },
        loadMaleFemaleChart: function () {
            loadMaleFemaleChart(_args.maleFemaleRoute);
        },
        loadDistrictStaffChart: function () {
            loadDistrictStaffChart(_args.districtStaffRoute);
        },
        loadAgeGroupStaffChart: function () {
            loadAgeGroupStaffChart(_args.ageGroupStaffRoute);
        },
    };
})();

function loadOverAllTarget(url) {
    if (sessionStorage.getItem("_loadOverAllTarget_") != 1) {
        sessionStorage.setItem("_loadOverAllTarget_", "1");
        $.get(url, function (data) {
            showTargetStatChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadOverAllTarget_");
            $(".overall-target-body").html(err.responseJSON);
        });
    }
}

function loadTop5TargetAchievementBranch(url) {
    if (sessionStorage.getItem("_loadTop5TargetAchievementBranch_") != 1) {
        sessionStorage.setItem("_loadTop5TargetAchievementBranch_", "1");
        $.get(url, function (data) {
            showBranchTargetStatChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadTop5TargetAchievementBranch_");
            $(".branch-target-body").html(err.responseJSON);
        });
    }
}

function loadMyBranchTargetAchievementCluster(url) {
    if (sessionStorage.getItem("_loadMyBranchTargetAchievementCluster_") != 1) {
        sessionStorage.setItem("_loadMyBranchTargetAchievementCluster_", "1");
        $.get(url, function (data) {
            showSelfBranchTargetStatChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadMyBranchTargetAchievementCluster_");
            $(".branch-target-body").html(err.responseJSON);
        });
    }
}
function loadTop5TargetAchievementCluster(url) {
    if (sessionStorage.getItem("_loadTop5TargetAchievementCluster_") != 1) {
        sessionStorage.setItem("_loadTop5TargetAchievementCluster_", "1");
        $.get(url, function (data) {
            showClusterTargetStatChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadTop5TargetAchievementCluster_");
            $(".cluster-target-body").html(err.responseJSON);
        });
    }
}

function loadTop5TargetAchievementStaff(url) {
    if (sessionStorage.getItem("_loadTop5TargetAchievementStaff_") != 1) {
        sessionStorage.setItem("_loadTop5TargetAchievementStaff_", "1");
        $.get(url, function (data) {
            showStaffTargetStatChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadTop5TargetAchievementStaff_");
            $(".staff-target-body").html(err.responseJSON);
        });
    }
}

function loadTop5KpaScorer(url) {
    if (sessionStorage.getItem("_loadTop5KpaScorer_") != 1) {
        sessionStorage.setItem("_loadTop5KpaScorer_", "1");
        $.get(url, function (data) {
            showKpaScorer(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadTop5KpaScorer_");
            $(".kpa-scorer-body").html(err.responseJSON);
        });
    }
}

function loadTop5PaScorer(url) {
    if (sessionStorage.getItem("_loadTop5PaScorer_") != 1) {
        sessionStorage.setItem("_loadTop5PaScorer_", "1");
        $.get(url, function (data) {
            showPaScorer(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadTop5PaScorer_");
            $(".pa-scorer-body").html(err.responseJSON);
        });
    }
}

function top5ClusterHeadScorer(url) {
    if (sessionStorage.getItem("_top5ClusterHeadScorer_") != 1) {
        sessionStorage.setItem("_top5ClusterHeadScorer_", "1");
        $.get(url, function (data) {
            showClusterHeadScorer(data);
        }).fail(function (err) {
            sessionStorage.clear("_top5ClusterHeadScorer_");
            $(".cluster-head-scorer").html(err.responseJSON);
        });
    }
}
function top5DepartmentScorer(url) {
    if (sessionStorage.getItem("_top5DepartmentScorer_") != 1) {
        sessionStorage.setItem("_top5DepartmentScorer_", "1");
        $.get(url, function (data) {
            showDepartmentScorer(data);
        }).fail(function (err) {
            sessionStorage.clear("_top5DepartmentScorer_");
            $(".department-scorer").html(err.responseJSON);
        });
    }
}

function recentExamLearningNDevScorer(url) {
    if (sessionStorage.getItem("_recentExamLearningNDevScorer_") != 1) {
        sessionStorage.setItem("_recentExamLearningNDevScorer_", "1");
        $.get(url, function (data) {
            showRecentExamLearningNDevScorer(data);
        }).fail(function (err) {
            sessionStorage.clear("_recentExamLearningNDevScorer_");
            $(".learning-dev-scorer").html(err.responseJSON);
        });
    }
}

function top5LearningNDevScorer(url) {
    if (sessionStorage.getItem("_top5LearningNDevScorer_") != 1) {
        sessionStorage.setItem("_top5LearningNDevScorer_", "1");
        $.get(url, function (data) {
            showTopLearningNDevScorer(data);
        }).fail(function (err) {
            sessionStorage.clear("_top5LearningNDevScorer_");
            $(".top5-lnd-scorer").html(err.responseJSON);
        });
    }
}

function loadMaleFemaleChart(url) {
    if (sessionStorage.getItem("_MaleFemaleChart_") != 1) {
        sessionStorage.setItem("_MaleFemaleChart_", "1");
        $.get(url, function (data) {
            showMaleFemaleStatChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_MaleFemaleChart_");
            $(".mal-female-body").html(err.responseJSON);
        });
    }
}
function loadDistrictStaffChart(url) {
    if (sessionStorage.getItem("_DistrictStaffChart_") != 1) {
        sessionStorage.setItem("_DistrictStaffChart_", "1");
        $.get(url, function (data) {
            showDistrictStaffChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_DistrictStaffChart_");
            $(".district-staff-body").html(err.responseJSON);
        });
    }
}
function loadAgeGroupStaffChart(url) {
    if (sessionStorage.getItem("_loadAgeGroupStaffChart_") != 1) {
        sessionStorage.setItem("_loadAgeGroupStaffChart_", "1");
        $.get(url, function (data) {
            showAgeGroupStaffChart(data);
        }).fail(function (err) {
            sessionStorage.clear("_loadAgeGroupStaffChart_");
            $(".age-group-staff-body").html(err.responseJSON);
        });
    }
}
function showTargetStatChart(data) {
    var donutChartCanvas = $("#donutChart").get(0).getContext("2d");
    var donutData = {
        labels: ["Achieved Target", "Unachieved Target"],
        datasets: [
            {
                data: [data, data == 0 ? 0 : 100 - data],
                backgroundColor: ["#00a65a", "#f56954"],
            },
        ],
    };
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    };
    new Chart(donutChartCanvas, {
        type: "doughnut",
        data: donutData,
        options: donutOptions,
    });
}

function showAgeGroupStaffChart(data) {
    let labels = Object.keys(data);
    let ageGroups = Object.values(data);
    var donutChartCanvas = $("#ageGroupStaffChart").get(0).getContext("2d");
    var donutData = {
        labels: labels,
        datasets: [
            {
                data: ageGroups,
                backgroundColor: [
                    "#00a65a",
                    "#f56954",
                    "#6c757d",
                    "#ffc107",
                    "#6f42c1",
                ],
            },
        ],
    };
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    };
    new Chart(donutChartCanvas, {
        type: "doughnut",
        data: donutData,
        options: donutOptions,
    });
}

function showBranchTargetStatChart(data) {
    var filteredTarget = data.filter(function (target) {
        return target.report != 0;
    });

    let labels = [];
    let reports = [];
    filteredTarget.map(function (target) {
        labels.push(target.name);
        reports.push(target.report);
    });

    const ctx = document.getElementById("branchTargetChart");
    const myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Target Percentage",
                    data: reports,
                    backgroundColor: [
                        "#eb4034",
                        "#345beb",
                        "#266635",
                        "#1c1145",
                        "#b37120",
                        "#9c3b98",
                    ],

                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20,
                        },
                    },
                ],
            },
            //  resize: true,
            legend: { display: false },
            title: {
                display: false,
                text: "Top 5 branch target",
            },
        },
    });
}

function showClusterTargetStatChart(data) {
    var filteredTarget = data.filter(function (target) {
        return target.report != 0.0;
    });

    let labels = [];
    let reports = [];
    filteredTarget.map(function (target) {
        labels.push(target.name);
        reports.push(target.report);
    });

    const ctx = document.getElementById("clusterChart");
    const myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Target Percentage",
                    data: reports,
                    backgroundColor: [
                        "#345beb",
                        "#eb4034",
                        "#266635",
                        "#1c1145",
                        "#b37120",
                        "#9c3b98",
                    ],

                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20,
                        },
                    },
                ],
            },
            legend: false,
            title: {
                display: false,
                text: "Top 5 cluster target",
            },
        },
    });
}

function showStaffTargetStatChart(data) {
    var filteredUsers = data.filter(function (target) {
        return target.percentage != null;
    });
    if (filteredUsers.length == 0) {
        $(".top5-target-achieving-staff").html(getAchieverMsg());
        return;
    }
    var html = "";
    $.each(filteredUsers, function (key, user) {
        html += getAchieverContent(user);
        $(".top5-target-achieving-staff").html(html);
    });
}

function showKpaScorer(data) {
    var filteredUsers = data.filter(function (target) {
        return target.percentage != null;
    });

    if (filteredUsers.length == 0) {
        $(".top5-kpa-scorer").html(getAchieverMsg());
        return;
    }

    var html = "";
    $.each(filteredUsers, function (key, user) {
        html += getAchieverContent(user);
        $(".top5-kpa-scorer").html(html);
    });
}
function showPaScorer(data) {
    var filteredUsers = data.filter(function (target) {
        return target.percentage != null;
    });
    if (filteredUsers.length == 0) {
        $(".top5-pa-scorer").html(getAchieverMsg());
        return;
    }
    var html = "";
    $.each(filteredUsers, function (key, user) {
        html += getAchieverContent(user);
        $(".top5-pa-scorer").html(html);
    });
}
function showClusterHeadScorer(data) {
    var filteredUsers = data.filter(function (target) {
        return target.percentage != null;
    });

    if (filteredUsers.length == 0) {
        $(".cluster-head-scorer").html(getAchieverMsg());
        return;
    }
    var html = "";
    $.each(filteredUsers, function (key, user) {
        html += getAchieverContent(user);
        $(".cluster-head-scorer").html(html);
    });
}

function showDepartmentScorer(data) {
    var filteredUsers = data.filter(function (target) {
        return target.percentage != null;
    });
    if (filteredUsers.length == 0) {
        $(".department-scorer").html(getAchieverMsg());
        return;
    }
    var html = "";
    $.each(filteredUsers, function (key, user) {
        html += getAchieverContent(user);
        $(".department-scorer").html(html);
    });
}

function showTopLearningNDevScorer(data) {
    var filteredUsers = data.filter(function (target) {
        return target.percentage != null;
    });
    if (filteredUsers.length == 0) {
        $(".top5-lnd-scorer").html(getAchieverMsg());
        return;
    }
    var html = "";
    $.each(filteredUsers, function (key, user) {
        html += getAchieverContent(user);
        $(".top5-lnd-scorer").html(html);
    });
}

function showRecentExamLearningNDevScorer(data) {
    if ($.isEmptyObject(data)) {
        $(".learning-dev-scorer").html(getAchieverMsg());
        return;
    }
    var html = getTopAchieverContent(data);
    $(".learning-dev-scorer").html(html);
    $("#lnd-exam").html("[" + data.exam + "]");
}
function showDistrictStaffChart(data) {
    var filteredDistrict = data.filter(function (district) {
        return district.total != 0;
    });

    let labels = [];
    let reports = [];
    let bgColors = [];
    filteredDistrict.map(function (district) {
        labels.push(district.title);
        reports.push(district.total);
        bgColors.push("#007bff");
    });

    const ctx = document.getElementById("districtStaffChart");
    const myChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Staffs by district",
                    data: reports,
                    backgroundColor: bgColors,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}

function showSelfBranchTargetStatChart(data) {
    console.log("data: ", data);
    let branchTargetReport = data && data.my_branch_target_report.toFixed(2);
    let selfTargetReport = data && data.self_target_report.toFixed(2);

    let branchTarget = $("#branch-target-progressbar .progress-bar");
    branchTarget["aria-valuenow"] = branchTargetReport;
    branchTarget.text(branchTargetReport);
    branchTarget.css("width", branchTargetReport + "%");

    let selfTarget = $("#self-target-progressbar .progress-bar");
    selfTarget["aria-valuenow"] = selfTargetReport;
    selfTarget.text(selfTargetReport);
    selfTarget.css("width", selfTargetReport + "%");
}
function showMaleFemaleStatChart(data) {
    let totalEmp = data.reduce(function (prev, current) {
        return prev + current.total;
    }, 0);

    male = calculatePercent((data[0] && data[0]["total"]) || null, totalEmp);
    female = calculatePercent((data[1] && data[1]["total"]) || null, totalEmp);

    const ctx = document.getElementById("maleFemeChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Male/Female"],
            datasets: [
                {
                    label: "Male " + male + "(%)",
                    data: [male],
                    backgroundColor: ["#345beb"],

                    borderWidth: 1,
                },
                {
                    label: "Female " + female + "(%)",
                    data: [female],
                    backgroundColor: ["#eb4034"],

                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20,
                        },
                    },
                ],
            },
        },
    });
}
function calculatePercent(obtained, total) {
    if (total == null) {
        return 0;
    }
    let percent = (obtained / total) * 100;
    return percent.toFixed(2);
}

function getAchieverMsg() {
    return `<div class="callout callout-danger">
    <h5>No Any Achievers Found Yet</h5>
    <p>Yo can be one of the top 5 achievers.</p>
    </div>`;
}

function getAchieverContent(data) {
    let html = `
    <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon"><img
                                src="${data.image}"
                                class="img-circle elevation-1" alt="${data.name}"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">${data.name}</span>
                            <span class="info-box-number">
                                ${data.percentage}
                                <small>%</small>
                            </span>
                        </div>
    
                    </div>
                </div>`;

    return html;
}
function getTopAchieverContent(data) {
    let html = `<div class="info-box">
        <span class="info-box-icon"><img
                src="${data.image}"
                class="img-circle elevation-1" alt="${data.name}"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">${data.name}</span>
            <span class="info-box-number">
                ${data.percentage}
                <small>%</small>
            </span>
        </div>

        </div>`;
    return html;
}
