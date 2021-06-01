export const g = {
    toWord(id,name='document'){
      let header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
        "xmlns:w='urn:schemas-microsoft-com:office:word' "+
        "xmlns='http://www.w3.org/TR/REC-html40'>"+
        "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
       let footer = "</body></html>";
       let sourceHTML = header+document.getElementById(id).innerHTML+footer;

       let source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       let fileDownload = document.createElement("a");
      document.body.appendChild(fileDownload);
      fileDownload.href = source;
      fileDownload.download = name+'.doc';
      fileDownload.click();
      document.body.removeChild(fileDownload);
    },
    getFirstLetter(name){
      if (name) {
          return name.substring(0,1)
      }
    },
    typeOfInternationalCargo(){
      return [
        {key:'export',name:'Экспорт'},
        {key:'import',name:'Импорт'},
        {key:'tranzit',name:'Транзит'},
      ];
    },
    findTypeOfInternationalCargo(key){
      let result = ''
      let types = [
        {key:'export',name:'Экспорт'},
        {key:'import',name:'Импорт'},
        {key:'tranzit',name:'Транзит'},
        {key:'all',name:'Общее'},
      ]
      types.forEach((item,index)=>{
        if (item.key == key) {
          result = item.name
        }
      })
      return result
    },
    typeOfAvtoActivity(){
      return [
        {key:'passenger_transportation',name:'Йўловчи ташиш',unit:'минг йўловчи'},
        {key:'passenger_turnover',name:'Йўловчи айланмаси',unit:'млн йўловчи/км'},
        {key:'shipping',name:'Юк ташиш',unit:'минг тонна'},
        {key:'cargo_turnover',name:'Юк айланмаси',unit:'млн тонна/км'},
      ];
    },
    findTypeOfAvtoActivity(key){
      let result = ''
      let types = [
        {key:'passenger_transportation',name:'Йўловчи ташиш'},
        {key:'passenger_turnover',name:'Йўловчи айланмаси'},
        {key:'shipping',name:'Юк ташиш'},
        {key:'cargo_turnover',name:'Юк айланмаси'},
      ]
      types.forEach((station,index)=>{
        if (station.key == key) {
          result = station.name
        }
      })
      return result
    },
    findUnitTypeOfAvtoActivity(key){
      let result = ''
      let types = [
        {key:'passenger_transportation',name:'Йўловчи ташиш',unit:'минг йўловчи'},
        {key:'passenger_turnover',name:'Йўловчи айланмаси',unit:'млн йўловчи/км'},
        {key:'shipping',name:'Юк ташиш',unit:'минг тонна'},
        {key:'cargo_turnover',name:'Юк айланмаси',unit:'млн тонна/км'},
      ];
      types.forEach((station,index)=>{
        if (station.key == key) {
          result = station.unit
        }
      })
      return result
    },
    typeOfAvtoQuarter(){
      return [
        {id:1,name:'I чорак'},
        {id:2,name:'II чорак'},
        {id:3,name:'III чорак'},
        {id:4,name:'IV чорак'},
      ];
    },
    findTypeOfAvtoQuarter(id){
      let result = ''
      let types = [
        {id:1,name:'I чорак'},
        {id:2,name:'II чорак'},
        {id:3,name:'III чорак'},
        {id:4,name:'IV чорак'},
      ]
      types.forEach((station,index)=>{
        if (station.id == id) {
          result = station.name
        }
      })
      return result
    },
    replaceCommaToDot(val){
      if(val != ''){
        val = val.replace(/,/g, '.')
        return val
      }
    },
    getYear(year){
      if(year){
        let new_date = year.split('-')
        let myDay = Number(new_date[0]);
        return myDay;
      }
    },
    getDay(day){
      if(day){
        // let new_date = new Date(day);
        let new_date = day.split('-')
        let myDay = Number(new_date[2]);
        return myDay;
      }
    },
    getMonth(month){
      if(month){
        let new_date = day.split('-')
        let myDay = Number(new_date[1]);
        return myDay;
      }
    },
    getMonthInLetter(date){
    if (date) {
      // let new_date = new Date(date);
      // let month = new_date.getMonth();
      let new_date = date.split('-')
      let month = Number(new_date[1]);
      let months=[
        {id:1,name:'январь',key:'yanvar'},
        {id:2,name:'февраль',key:'fevral'},
        {id:3,name:'март',key:'mart'},
        {id:4,name:'апрель',key:'aprel'},
        {id:5,name:'май',key:'may'},
        {id:6,name:'июнь',key:'iyun'},
        {id:7,name:'июль',key:'iyul'},
        {id:8,name:'август',key:'avgust'},
        {id:9,name:'сентябрь',key:'sentabr'},
        {id:10,name:'октябрь',key:'oktabr'},
        {id:11,name:'ноябрь',key:'noyabr'},
        {id:12,name:'декабрь',key:'dekabr'},
      ];
      months.forEach((items,index)=>{
        if(month == items.id){
            name = items.name
        }
      })
      return name
    }else{
      return date
    }
  },
  filterMonthTitles(items=[]){
    let months = [
      {id:1,name:'январь',key:'yanvar'},
      {id:2,name:'февраль',key:'fevral'},
      {id:3,name:'март',key:'mart'},
      {id:4,name:'апрель',key:'aprel'},
      {id:5,name:'май',key:'may'},
      {id:6,name:'июнь',key:'iyun'},
      {id:7,name:'июль',key:'iyul'},
      {id:8,name:'август',key:'avgust'},
      {id:9,name:'сентябрь',key:'sentabr'},
      {id:10,name:'октябрь',key:'oktabr'},
      {id:11,name:'ноябрь',key:'noyabr'},
      {id:12,name:'декабрь',key:'dekabr'},
    ];
    let result= []
    if(items.length > 0){
      items.forEach((item,index)=>{
        months.forEach((value,m_index)=>{
          if(item == value.key){
            result.push(value)
          }
        })
      })
    }else{
      result = months
    }
    return result
  },
  allMonths(){
    return [
        {id:1,name:'январь',key:'yanvar'},
        {id:2,name:'февраль',key:'fevral'},
        {id:3,name:'март',key:'mart'},
        {id:4,name:'апрель',key:'aprel'},
        {id:5,name:'май',key:'may'},
        {id:6,name:'июнь',key:'iyun'},
        {id:7,name:'июль',key:'iyul'},
        {id:8,name:'август',key:'avgust'},
        {id:9,name:'сентябрь',key:'sentabr'},
        {id:10,name:'октябрь',key:'oktabr'},
        {id:11,name:'ноябрь',key:'noyabr'},
        {id:12,name:'декабрь',key:'dekabr'},
      ];
  },
  findKeyOfMonth(month){
    let name = ''
    if(month){
      let months=[
        {id:1,name:'январь',key:'yanvar'},
        {id:2,name:'февраль',key:'fevral'},
        {id:3,name:'март',key:'mart'},
        {id:4,name:'апрель',key:'aprel'},
        {id:5,name:'май',key:'may'},
        {id:6,name:'июнь',key:'iyun'},
        {id:7,name:'июль',key:'iyul'},
        {id:8,name:'август',key:'avgust'},
        {id:9,name:'сентябрь',key:'sentabr'},
        {id:10,name:'октябрь',key:'oktabr'},
        {id:11,name:'ноябрь',key:'noyabr'},
        {id:12,name:'декабрь',key:'dekabr'},
      ];
      months.forEach((items,index)=>{
        if(month == items.name){
          name = items.key
        }
      })  
    }
    return name
  },
  findValueOfMonth(month){
    let name = ''
    if(month){
      let months=[
        {id:1,name:'январь',key:'yanvar'},
        {id:2,name:'февраль',key:'fevral'},
        {id:3,name:'март',key:'mart'},
        {id:4,name:'апрель',key:'aprel'},
        {id:5,name:'май',key:'may'},
        {id:6,name:'июнь',key:'iyun'},
        {id:7,name:'июль',key:'iyul'},
        {id:8,name:'август',key:'avgust'},
        {id:9,name:'сентябрь',key:'sentabr'},
        {id:10,name:'октябрь',key:'oktabr'},
        {id:11,name:'ноябрь',key:'noyabr'},
        {id:12,name:'декабрь',key:'dekabr'},
      ];
      months.forEach((items,index)=>{
        if(month == items.key){
          name = items.name
        }
      })  
    }
    return name
  },
  findIdOfMonth(month){
    let name = ''
    if(month){
      let months=[
        {id:1,name:'январь',key:'yanvar'},
        {id:2,name:'февраль',key:'fevral'},
        {id:3,name:'март',key:'mart'},
        {id:4,name:'апрель',key:'aprel'},
        {id:5,name:'май',key:'may'},
        {id:6,name:'июнь',key:'iyun'},
        {id:7,name:'июль',key:'iyul'},
        {id:8,name:'август',key:'avgust'},
        {id:9,name:'сентябрь',key:'sentabr'},
        {id:10,name:'октябрь',key:'oktabr'},
        {id:11,name:'ноябрь',key:'noyabr'},
        {id:12,name:'декабрь',key:'dekabr'},
      ];
      months.forEach((items,index)=>{
        if(month == items.name){
          name = items.id
        }
      })  
    }
    return name
  },
  getFreedomAirs(){
    let items = [
      {key:'1',value:'Биринчи'},
      {key:'2',value:'Иккинчи'},
      {key:'3',value:'Учинчи'},
      {key:'4',value:'Туртинчи'},
      {key:'5',value:'Бешинчи'},
      {key:'6',value:'Олтинчи'},
      {key:'7',value:'Еттинчи'},
      {key:'8',value:'Саккизинчи'},
      {key:'9',value:'Туккизинчи'},
    ]
    return items
  },
  findFreedomAir(item){
    let name = ''
    if(item){
      let items=[
        {key:'1',value:'Биринчи'},
        {key:'2',value:'Иккинчи'},
        {key:'3',value:'Учинчи'},
        {key:'4',value:'Туртинчи'},
        {key:'5',value:'Бешинчи'},
        {key:'6',value:'Олтинчи'},
        {key:'7',value:'Еттинчи'},
        {key:'8',value:'Саккизинчи'},
        {key:'9',value:'Туккизинчи'},
      ];
      items.forEach((val,index)=>{
        if(item == val.key){
          name = val.value
        }
      })  
    }
    return name
  },
  getFlightModes(){
    let items = [
      {key:'clear_sky',value:'Очиқ осмон'},
      {key:'by_agreement',value:'Келишув асосида'},
    ]
    return items
  },
  findFlightMode(item){
    let name = ''
    if(item){
      let items=[
        {key:'clear_sky',value:'Очиқ осмон'},
        {key:'by_agreement',value:'Келишув асосида'},
      ];
      items.forEach((val,index)=>{
        if(item == val.key){
          name = val.value
        }
      })  
    }
    return name
  },
  getTypeAirports(){
    let items = [
      {key:'international',value:'Xалқаро'},
      {key:'local',value:'Ички'},
    ]
    return items
  },
  findTypeAirports(item){
    let name = ''
    if(item){
      let items=[
        {key:'international',value:'Xалқаро'},
        {key:'local',value:'Ички'},
      ];
      items.forEach((val,index)=>{
        if(item == val.key){
          name = val.value
        }
      })  
    }
    return name
  },
  getAviaTypes(){
    let items = [
      {key:'cargo',value:'Юк'},
      {key:'passenger ',value:'Йўловчи'},
    ]
    return items
  },
  findAviaTypes(item){
    let name = ''
    if(item){
      let items=[
        {key:'cargo',value:'Юк'},
        {key:'passenger ',value:'Йўловчи'},
      ];
      items.forEach((val,index)=>{
        if(item == val.key){
          name = val.value
        }
      })  
    }
    return name
  },
}
