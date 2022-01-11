class mfFormStorage {
  $targetForm;
  $storage;
  $formElements;
  constructor($formname, $storagename){
    this.$targetForm = $formname;
    this.$storage = $storagename;
    var form = document.querySelector(`#${$formname}`);
    this.$formElements = form.elements;
  }
  getData(){
    let data = { [this.$storage]: {} };
    data[this.$storage]
    for (const element of this.$formElements ) {
      if (element.name.length > 0) {
        if( ( element.type === 'radio' || element.type === 'checkbox' )  && !element.checked){
          if( element.type === 'checkbox') data[this.$storage][element.name] = undefined
        }else if( element.type !== 'file' ) data[this.$storage][element.name] = element.value;
      }
    }
    return data;
  }
  loadData() {
    if ( localStorage.getItem(this.$storage) ) {
      const savedData = JSON.parse(localStorage.getItem(this.$storage)); // get and parse the saved data from localStorage
      console.log ( this.$storage )
      for (const element of this.$formElements) {
        if (element.name in savedData) {
          if( element.type === 'radio' || element.type === 'checkbox'){
            if( element.value == savedData[element.name] ) {
              element.checked = true;
            }else element.checked = false;
          }else if( element.type !== 'file' ) element.value = savedData[element.name];
        } else if( element.type === 'radio' || element.type === 'checkbox'){
          element.checked = false;
        }
      }
    }
    $("#pop-page-form input").off('click').off('change').off('focusin')
  }
  save(){
    let data = this.getData();
    localStorage.setItem(this.$storage, JSON.stringify(data[this.$storage]));
    console.log ( data[this.$storage] )
  }
}
//var fsss = new mfFormStorage('pop-page-form','pop-page-form-nface' )
