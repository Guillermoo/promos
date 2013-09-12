  $(document).ready(function () {
            //$(":wijmo-wijdialog").wijdialog("destroy").remove();
            $("#dialog-message").wijdialog({
                autoOpen: false,
                height: 180,
                width: 400,
                modal: true,
                buttons: {
                    Ok: function () {
                        $(this).wijdialog("close");
                    }
                },
                captionButtons: {
                    pin: { visible: false },
                    refresh: { visible: false },
                    toggle: { visible: false },
                    minimize: { visible: false },
                    maximize: { visible: false }
                }
            });
        });



 $(function() {
  //getter
var scroll = $( ".selector" ).sortable( "option", "scroll" );
//setter
$( ".selector" ).sortable( "option", "scroll", false );
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });


  $(document).ready(function () {



      $("#wijlinechartDefault").wijlinechart({

        animation: {

          direction: "vertical"

        },

        axis: {

          y: {

            text: "Number of Hits",

            labels: {

              style: {

                fill: "#4BB446",

                "font-size": 11

              }

            },

            gridMajor: {

              style: { stroke: "#4BB446", "stroke-dasharray": "- " }

            },

            tickMajor: { position: "outside", style: { stroke: "#4BB446"} },

            tickMinor: { position: "outside", style: { stroke: "#4BB446"} },

            autoMax: false,

            max: 100,

            autoMin: false,

            min: 0

          },

          x: {

            text: "Month of the Year",

            labels: {

              style: {

                fill: "#4BB446",

                "font-size": 11,

                rotation: -45

              }

            },

            tickMajor: { position: "outside", style: { stroke: "#7f7f7f"} }

          }

        },

        showChartLabels: false,

        hint: {

          content: function () {

            return this.data.lineSeries.label + '\n' +

            this.x + '\n' + this.y + '';

          },

          contentStyle: {

            "font-size": 10

          },

          offsetY: -10

        },

        legend: {

          visible: false

        },

        seriesList: [createRandomSeriesList("2010")],

        seriesStyles: [

          { stroke: "#4BB446", "stroke-width": 3 }

        ],

        seriesHoverStyles: [

          {"stroke-width": 4 }

        ]

      });

    });







    function changeProperties() {

      var animation = {},

        seriesTransition = {},

        enabled = $("#chkEnabled").is(":checked"),

        direction = $("#selDirection").val(),

        duration = $("#inpDuration").val(),

        easing = $("#selEasing").val(),

        stEnabled = $("#chkSTEnabled").is(":checked"),

        stDuration = $("#inpSTDuration").val(),

        stEasing = $("#selSTEasing").val();

      animation.enabled = enabled;

      animation.direction = direction;

      if (duration && duration.length) {

        animation.duration = parseFloat(duration);

      }

      animation.easing = easing;



      seriesTransition.enabled = stEnabled;

      if (stDuration && stDuration.length) {

        seriesTransition.duration = parseFloat(stDuration);

      }

      seriesTransition.easing = stEasing;

      $("#wijlinechartDefault").wijlinechart("option", "animation", animation);

      $("#wijlinechartDefault").wijlinechart("option", "seriesTransition", seriesTransition);

    }



    function reload() {

      $("#wijlinechartDefault").wijlinechart("option", "seriesList", [createRandomSeriesList("2010")]);

    }



    function createRandomSeriesList(label) {

      var data = [],

        randomDataValuesCount = 12,

        labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",

          "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

        idx;

      for (idx = 0; idx < randomDataValuesCount; idx++) {

        data.push(createRandomValue());

      }

      return {

        label: "Data",

        legendEntry: true,

        fitType: "spline",

        markers: {

          visible: true,

          type: "circle"

        },

        data: { x: labels, y: data }

      };

    }



    function createRandomValue() {

      var val = Math.round(Math.random() * 100);

      return val;

    }

        $(document).ready(function () {
      $("#wijlinechart").wijlinechart({
        showChartLabels: false,
        header: {
          text: "Line Graph Title Goes Here"
        },
        hint: {
          content: function () {
            return this.y;
          },
          offsetY: -10
        },
        seriesList: [
          {
            label: "#Wijmo",
            legendEntry: false,
            data: {
              x: [new Date("10/21/2010"), new Date("10/22/2010"), new Date("10/23/2010"), new Date("10/24/2010"), new Date("10/25/2010"), new Date("10/26/2010"), new Date("10/27/2010"), new Date("10/28/2010"), new Date("10/29/2010")],
              y: [12, 30, 6, 22, 14, 25, 41, 14, 3]
            },
            markers: {
              visible: true,
              type: "circle",
              symbol: [
                {
                  index: 6,
                  url: "http://cdn.wijmo.com/images/wijmo.png",
                  width: 30,
                  height: 30
                },
                {
                  index: 2,
                  url: "http://cdn.wijmo.com/images/hatemo.png",
                  width: 30,
                  height: 30
                }
              ]
            }
          }
        ],
        seriesStyles: [{
          stroke: "#6148B3", "stroke-width": 5, opacity: 0.8
        }],
        seriesHoverStyles: [{
          "stroke-width": 8, opacity: 1
        }]
      });

    })



        $(document).ready(function () {
      $("#wijareachart").wijlinechart({
        type: "area",
        showChartLabels: false,
        header: {
          text: "Line Graph Title Goes Here"
        },
        hint: {
          content: function () {
            return this.y;
          },
          offsetY: -10
        },
        seriesList: [
          {
            label: "#Wijmo",
            fitType: "spline",
            legendEntry: false,
            data: {
              x: [new Date("10/21/2010"), new Date("10/22/2010"), new Date("10/23/2010"), new Date("10/24/2010"), new Date("10/25/2010"), new Date("10/26/2010"), new Date("10/27/2010"), new Date("10/28/2010"), new Date("10/29/2010")],
              y: [12, 30, 6, 22, 14, 25, 41, 14, 3]
            }
          }
        ],
        seriesStyles: [{
          stroke: "#00a6dd", "stroke-width": 5, opacity: 0.8
        }],
        seriesHoverStyles: [{
          "stroke-width": 8, opacity: 1
        }]
      });
    });


     $(document).ready(function () {
      $("#wijbarchart").wijbarchart({
        axis: {
          y: {
            text: "Number of Hits",
            autoMax: false,
            max: 100,
            autoMin: false,
            min: 0

          },
          x: {
            text: "Month of the Year"
          }
        },
        hint: {
          content: function () {
            return this.data.label + '\n ' + this.y + '';
          }
        },
        stacked: true,
        clusterRadius: 5,
        seriesList: [createRandomSeriesList("2010")]
      });
    });


    function changeProperties() {
      var seriesTransition = {};
      enabled = $("#chkEnabled").is(":checked"),
        duration = $("#inpDuration").val(),
        easing = $("#selEasing").val();
      seriesTransition.enabled = enabled;
      if (duration && duration.length) {
        seriesTransition.duration = parseFloat(duration);
      }
      seriesTransition.easing = easing;
      $("#wijbarchart").wijbarchart("option", "seriesTransition", seriesTransition);
    }

    function reload() {
      $("#wijbarchart").wijbarchart("option", "seriesList", [createRandomSeriesList("2010")]);
    }

    function createRandomSeriesList(label) {
      var data = [],
        randomDataValuesCount = 12,
        labels = ["January", "February", "March", "April", "May", "June",
          "July", "August", "September", "October", "November", "December"],
        idx;
      for (idx = 0; idx < randomDataValuesCount; idx++) {
        data.push(createRandomValue());
      }
      return {
        label: label,
        legendEntry: false,
        data: { x: labels, y: data }
      };
    }

    function createRandomValue() {
      var val = Math.round(Math.random() * 100);
      return val;
    }