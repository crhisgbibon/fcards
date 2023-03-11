<style>
  :root{
    --green: rgba(150, 225, 150, 1);
    --greenBorder: rgba(125, 175, 125, 1);
    --red: rgba(225, 150, 150, 1);
    --redBorder: rgba(175, 125, 125, 1);
  }
</style>

<script type="module" src="https://cdn.jsdelivr.net/npm/chart.js@4.1.1/dist/chart.umd.min.js"></script>

<script>
  // Stat
  const LastStat = document.getElementById("LastStat");
  const Stat = document.getElementById("Stat");
  const NextStat = document.getElementById("NextStat");
  // Period
  const LastPeriod = document.getElementById("LastPeriod");
  const Period = document.getElementById("Period");
  const NextPeriod = document.getElementById("NextPeriod");
  // StatSelect - declared in stat.js
  StatSelect.onchange = function() { LoadTable(); };

  // Stat
  LastStat.onclick = function() { AnimatePop2(LastStat); LastS(); };
  NextStat.onclick = function() { AnimatePop2(NextStat); NextS(); };
  // Period
  LastPeriod.onclick = function() { AnimatePop2(LastPeriod); LastP(); };
  NextPeriod.onclick = function() { AnimatePop2(NextPeriod); NextP(); };

  let currentStat = 0, currentPeriod = 0;
  const s = ["Totals", "History"];
  const p = ["Forever", "Today", "Week", "Month", "Year"];
  let allSuccess, allStreaks, allHistory;

  let style = getComputedStyle(document.body);
  let red = style.getPropertyValue('--red');
  let green = style.getPropertyValue('--green');
  let redBorder = style.getPropertyValue('--redBorder');
  let greenBorder = style.getPropertyValue('--greenBorder');

  function NextS()
  {
    currentStat++;
    if(currentStat > s.length - 1) currentStat = 0;
    Stat.innerHTML = s[currentStat];
    AnimateFromRight2(Stat);
    LoadTable();
  }

  function LastS()
  {
    currentStat--;
    if(currentStat < 0) currentStat = s.length - 1;
    Stat.innerHTML = s[currentStat];
    AnimateFromLeft2(Stat);
    LoadTable();
  }

  function NextP()
  {
    currentPeriod++;
    if(currentPeriod > p.length - 1) currentPeriod = 0;
    Period.innerHTML = p[currentPeriod];
    AnimateFromRight2(Period);
    LoadTable();
  }

  function LastP()
  {
    currentPeriod--;
    if(currentPeriod < 0) currentPeriod = p.length - 1;
    Period.innerHTML = p[currentPeriod];
    AnimateFromLeft2(Period);
    LoadTable();
  }

  function AnimatePop2(panel)
  {
    panel.animate([
      { transform: 'scale(110%, 110%)'},
      { transform: 'scale(109%, 109%)'},
      { transform: 'scale(108%, 108%)'},
      { transform: 'scale(107%, 107%)'},
      { transform: 'scale(106%, 106%)'},
      { transform: 'scale(105%, 105%)'},
      { transform: 'scale(104%, 104%)'},
      { transform: 'scale(103%, 103%)'},
      { transform: 'scale(102%, 102%)'},
      { transform: 'scale(101%, 101%)'},
      { transform: 'scale(100%, 100%)'}],
      {
        duration: 100,
      }
    );
  }

  function AnimateFromRight2(panel)
  {
    panel.animate(
    [
      { transform: 'translateX(+25%)', opacity: '0.0' },
      { transform: 'translateX(+20%)',  opacity: '0.25' },
      { transform: 'translateX(+15%)',  opacity: '0.50' },
      { transform: 'translateX(+10%)',  opacity: '0.75' },
      { transform: 'translateX(+5%)',  opacity: '1.0' },
      { transform: 'translateX(0%)',  opacity: '1.0' },
      { transform: 'translateX(-5%)',  opacity: '1.0' },
      { transform: 'translateX(-10%)',  opacity: '1.0' },
      { transform: 'translateX(-7.5%)',  opacity: '1.0' },
      { transform: 'translateX(-5%)',  opacity: '1.0' },
      { transform: 'translateX(-2.5%)',  opacity: '1.0' },
      { transform: 'translateX(0%)',  opacity: '1.0' },
    ],
    {
      duration: 150,
    }
  );
  }

  function AnimateFromLeft2(panel)
  {
    panel.animate(
    [
      { transform: 'translateX(-25%)', opacity: '0.0' },
      { transform: 'translateX(-20%)',  opacity: '0.25' },
      { transform: 'translateX(-15%)',  opacity: '0.50' },
      { transform: 'translateX(-10%)',  opacity: '0.75' },
      { transform: 'translateX(-5%)',  opacity: '1.0' },
      { transform: 'translateX(0%)',  opacity: '1.0' },
      { transform: 'translateX(+5%)',  opacity: '1.0' },
      { transform: 'translateX(+10%)',  opacity: '1.0' },
      { transform: 'translateX(+7.5%)',  opacity: '1.0' },
      { transform: 'translateX(+5%)',  opacity: '1.0' },
      { transform: 'translateX(+2.5%)',  opacity: '1.0' },
      { transform: 'translateX(0%)',  opacity: '1.0' },
    ],
    {
      duration: 150,
    }
  );
  }

  function LoadTable()
  {
    // console.log(Chart);
    // console.log(summary);
    // console.log(logs);
    // console.log(cards);
    // console.log(decks);
    // console.log(stacks);
    // console.log(days);
    // console.log(months);

    let stat = Stat.innerHTML.trim();
    let period = Period.innerHTML.trim();
    if(stat === s[0])
    {
      PieChart(period);
    }
    else
    {
      StackedBarChart(stat, period);
    }
  }

  function PieChart(period)
  {
    if(window.chart !== undefined) if(window.chart !== null) window.chart.destroy();

    if(summary === null || summary === undefined) return;

    let wrong = 0, right = 0, percent = 0, total = 0;

    let type = parseInt(StatSelect.dataset.type);
    let index = parseInt(StatSelect.value);

    if(type === 0) // All
    {
      if(period === "Forever")
      {
        wrong = summary['wrongAll'];
        right = summary['rightAll'];
        percent = (summary['percentAll'] === 0) ? "No Data Found." : summary['percentAll'] + "%";
        total = summary['totalAll'];
      }
      else if(period === "Today")
      {
        wrong = summary['wrongDay'];
        right = summary['rightDay'];
        percent = (summary['percentDay'] === 0) ? "No Data Found." : summary['percentDay'] + "%";
        total = summary['totalDay'];
      }
      else if(period === "Week")
      {
        wrong = summary['wrongWeek'];
        right = summary['rightWeek'];
        percent = (summary['percentWeek'] === 0) ? "No Data Found." : summary['percentWeek'] + "%";
        total = summary['totalWeek'];
      }
      else if(period === "Month")
      {
        wrong = summary['wrongMonth'];
        right = summary['rightMonth'];
        percent = (summary['percentMonth'] === 0) ? "No Data Found." : summary['percentMonth'] + "%";
        total = summary['totalMonth'];
      }
      else if(period === "Year")
      {
        wrong = summary['wrongYear'];
        right = summary['rightYear'];
        percent = (summary['percentYear'] === 0) ? "No Data Found." : summary['percentYear'] + "%";
        total = summary['totalYear'];
      }
    }
    else if(type === 1) // Card
    {
      let id = cards[index]['id'];
      for(let i = 0; i < logs.length; i++)
      {
        if(period === "Today") if(logs[i].logTime < summary['today']) continue;
        if(period === "Week") if(logs[i].logTime < summary['week']) continue;
        if(period === "Month") if(logs[i].logTime < summary['month']) continue;
        if(period === "Year") if(logs[i].logTime < summary['year']) continue;
        if(logs[i].cardID === id)
        {
          if(logs[i].result)
          {
            right++;
            total++;
          }
          else
          {
            wrong++;
            total++;
          }
        }
      }
      percent = (total === 0) ? "No Data Found." : ( ( 100 / total ) * right ).toFixed(2) + "%";
    }
    else if(type === 2) // Deck
    {
      let id = decks[index]['id'];
      for(let i = 0; i < logs.length; i++)
      {
        if(period === "Today") if(logs[i].logTime < summary['today']) continue;
        if(period === "Week") if(logs[i].logTime < summary['week']) continue;
        if(period === "Month") if(logs[i].logTime < summary['month']) continue;
        if(period === "Year") if(logs[i].logTime < summary['year']) continue;
        if(logs[i].deckID === id)
        {
          if(logs[i].result)
          {
            right++;
            total++;
          }
          else
          {
            wrong++;
            total++;
          }
        }
      }
      percent = (total === 0) ? "No Data Found." : ( ( 100 / total ) * right ).toFixed(2) + "%";
    }
    else if(type === 3) // Stat
    {
      let id = stacks[index]['id'];
      for(let i = 0; i < logs.length; i++)
      {
        if(period === "Today") if(logs[i].logTime < summary['today']) continue;
        if(period === "Week") if(logs[i].logTime < summary['week']) continue;
        if(period === "Month") if(logs[i].logTime < summary['month']) continue;
        if(period === "Year") if(logs[i].logTime < summary['year']) continue;
        if(stacks[index]['decks'].includes(logs[i].deckID.toString()))
        {
          if(logs[i].result)
          {
            right++;
            total++;
          }
          else
          {
            wrong++;
            total++;
          }
        }
      }
      percent = (total === 0) ? "No Data Found." : ( ( 100 / total ) * right ).toFixed(2) + "%";
    }

    let data = [
      { output: "Wrong",
        count: wrong,
        backgroundColor: red,
        borderColor: redBorder,
      },
      { output: "Right",
        count: right,
        backgroundColor: green,
        borderColor: greenBorder,
      },
    ];

    const plugin = {
      id: 'customBackground',
      beforeDraw: (chart, args, options) => {
        const {ctx} = chart;
        ctx.save();
        ctx.globalCompositeOperation = 'destination-over';
        ctx.fillStyle = options.color || 'rgb(50,50,50)';
        ctx.textAlign = 'center';
        ctx.textBaseline = "middle";
        ctx.font = "bold 16px Nunito";
        ctx.fillText(percent, chart.width/2, chart.height/2);
        ctx.font = "bold 10px Nunito";
        ctx.fillText(total, chart.width/2, chart.height/2 + 20);
        ctx.restore();
      }
    };

    window.chart = new Chart(
      document.getElementById('Chart'),
      {
        type: 'doughnut',
        data: {
          labels: data.map(row => row.output),
          datasets: [
            {
              data: data.map(row => row.count),
              borderColor: data.map(row => row.borderColor),
              backgroundColor: data.map(row => row.backgroundColor),
            }
          ]
        },
        options: {
          plugins: {
            customBackground: {
              color: 'rgb(50,50,50)',
            },
            legend:false,
          },
        },
        plugins: [plugin],
      }
    );
  }

  function StackedBarChart(stat, period)
  {
    if(window.chart !== undefined) if(window.chart !== null) window.chart.destroy();

    let labels, right, wrong, backgroundColorR, borderColorR, backgroundColorW, borderColorW;

    let type = parseInt(StatSelect.dataset.type);
    let index = parseInt(StatSelect.value);

    if(type === 0) // All
    {
      if(period === "Forever")
      {
        labels = months.map(row => row.date);
        right = months.map(row => row.right);
        wrong = months.map(row => row.wrong);
        backgroundColorR = months.map(row => green);
        borderColorR = months.map(row => greenBorder);
        backgroundColorW = months.map(row => red);
        borderColorW = months.map(row => redBorder);
      }
      if(period === "Today" || period === "Week" || period === "Month" || period === "Year")
      {
        let newDays = [];
        if(period === "Today") newDays = days.filter(item => (item.stat === "DAY"));
        if(period === "Week") newDays = days.filter(item => (item.stat === "DAY" || item.stat === "WEEK"));
        if(period === "Month") newDays = days.filter(item => (item.stat === "DAY" || item.stat === "WEEK" || item.stat === "MONTH"));
        if(period === "Year") newDays = months.filter(item => (item.stat === "YEAR"));
        
        labels = newDays.map(row => row.date);
        right = newDays.map(row => row.right);
        wrong = newDays.map(row => row.wrong);
        backgroundColorR = newDays.map(row => green);
        borderColorR = newDays.map(row => greenBorder);
        backgroundColorW = newDays.map(row => red);
        borderColorW = newDays.map(row => redBorder);
      }
    }
    if(type === 1 || type === 2 || type === 3) // Card, Deck, Stack
    {
      let id = cards[index]['id'];
      if(type === 2) id = decks[index]['id'];
      if(type === 4) id = stacks[index]['id'];

      if(period === "Forever" || period === "Year")
      {
        let newMonths = [];
        if(period === "Year") newMonths = months.filter(item => (item.stat === "YEAR"));
        else newMonths = months;

        let tempMonth = [];
        for(let m = 0; m < newMonths.length; m++)
        {
          tempMonth.push([]);
          let monthStart = parseInt(newMonths[m]['monthStart']);
          let monthEnd = parseInt(newMonths[m]['monthEnd']);
          tempMonth[m]['right'] = 0;
          tempMonth[m]['wrong'] = 0;
          tempMonth[m]['date'] = newMonths[m]['date'];
          for(let i = 0; i < logs.length; i++)
          {
            if(logs[i].logTime < monthStart || logs[i].logTime > monthEnd) continue;
            if(
              (type === 1 && logs[i].cardID === id) ||
              (type === 2 && logs[i].deckID === id) ||
              (type === 3 && stacks[index]['decks'].includes(logs[i].deckID.toString()))
            )
            {
              if(logs[i].result)
              {
                tempMonth[m]['right']++;
              }
              else
              {
                tempMonth[m]['wrong']++;
              }
            }
          }
        }

        labels = tempMonth.map(row => row.date);
        right = tempMonth.map(row => row.right);
        wrong = tempMonth.map(row => row.wrong);
        backgroundColorR = tempMonth.map(row => green);
        borderColorR = tempMonth.map(row => greenBorder);
        backgroundColorW = tempMonth.map(row => red);
        borderColorW = tempMonth.map(row => redBorder);
      }
      if(period === "Today" || period === "Week" || period === "Month")
      {
        let newDays = [];
        if(period === "Today") newDays = days.filter(item => (item.stat === "DAY"));
        if(period === "Week") newDays = days.filter(item => (item.stat === "DAY" || item.stat === "WEEK"));
        if(period === "Month") newDays = days.filter(item => (item.stat === "DAY" || item.stat === "WEEK" || item.stat === "MONTH"));

        let tempDays = [];
        for(let m = 0; m < newDays.length; m++)
        {
          tempDays.push([]);
          let dayStart = parseInt(newDays[m]['dayStart']);
          let dayEnd = parseInt(newDays[m]['dayEnd']);
          tempDays[m]['right'] = 0;
          tempDays[m]['wrong'] = 0;
          tempDays[m]['date'] = newDays[m]['date'];
          for(let i = 0; i < logs.length; i++)
          {
            if(logs[i].logTime < dayStart || logs[i].logTime > dayEnd) continue;
            if(
              (type === 1 && logs[i].cardID === id) ||
              (type === 2 && logs[i].deckID === id) ||
              (type === 3 && stacks[index]['decks'].includes(logs[i].deckID.toString()))
            )
            {
              if(logs[i].result)
              {
                tempDays[m]['right']++;
              }
              else
              {
                tempDays[m]['wrong']++;
              }
            }
          }
        }
        
        labels = tempDays.map(row => row.date);
        right = tempDays.map(row => row.right);
        wrong = tempDays.map(row => row.wrong);
        backgroundColorR = tempDays.map(row => green);
        borderColorR = tempDays.map(row => greenBorder);
        backgroundColorW = tempDays.map(row => red);
        borderColorW = tempDays.map(row => redBorder);
      }
    }

    let data = {
      labels: labels,
      datasets: 
      [
        {
          label: 'Right',
          data: right,
          backgroundColor: backgroundColorR,
          borderColor: borderColorR,
          borderWidth: 1
        },
        {
          label: 'Wrong',
          data: wrong,
          backgroundColor: backgroundColorW,
          borderColor: borderColorW,
          borderWidth: 1
        },
      ]
    };

    window.chart = new Chart(
      document.getElementById('Chart'),
      {
        type: 'bar',
        data: data,
        options: {
          plugins: {
            legend:false,
          },
          scales: {
            x:
            {
              stacked: true,
            },
            y:
            {
              stacked: true,
              beginAtZero: true,
            }
          }
        },
      }
    );
  }

  document.addEventListener("DOMContentLoaded", LoadTable);

</script>