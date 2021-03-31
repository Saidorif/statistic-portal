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
        {key:'all',name:'Общее'},
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
        {id:1,name:'январь'},
        {id:2,name:'февраль'},
        {id:3,name:'март'},
        {id:4,name:'апрель'},
        {id:5,name:'май'},
        {id:6,name:'июнь'},
        {id:7,name:'июль'},
        {id:8,name:'августь'},
        {id:9,name:'сентябрь'},
        {id:10,name:'октябрь'},
        {id:11,name:'ноябрь'},
        {id:12,name:'декабрь'},
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
}
