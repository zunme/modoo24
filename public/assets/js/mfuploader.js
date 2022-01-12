/* resize upload */
var mfResizeImage = function (settings) {
    var file = settings.file;
    var maxSize = settings.maxSize;
    var reader = new FileReader();
    var image = new Image();
    var canvas = document.createElement('canvas');
    var dataURItoBlob = function (dataURI) {
        var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
            atob(dataURI.split(',')[1]) :
            unescape(dataURI.split(',')[1]);
        var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var max = bytes.length;
        var ia = new Uint8Array(max);
        for (var i = 0; i < max; i++)
            ia[i] = bytes.charCodeAt(i);
        return new Blob([ia], { type: 'image/jpeg'});
    };
    var resize = function () {
        var width = image.width;
        var height = image.height;
        if (width > height) {
            if (width > maxSize) {
                height *= maxSize / width;
                width = maxSize;
            }
        } else {
            if (height > maxSize) {
                width *= maxSize / height;
                height = maxSize;
            }
        }
        canvas.width = width;
         canvas.height = height;
        canvas.getContext('2d').drawImage(image, 0, 0, width, height);
        var dataUrl = canvas.toDataURL('image/jpeg');

        return [dataURItoBlob(dataUrl) , dataUrl ];
    };
    return new Promise(function (ok, no) {
        if (!file.type.match(/image.*/)) {
            no(new Error("Not an image"));
            return;
        }
        reader.onload = function (readerEvent) {
            image.onload = function () { return ok(resize()); };
            image.src = readerEvent.target.result;
        };
        reader.readAsDataURL(file);
    });
};

class mfPreviewImg {
  constructor(formname, option){
    this.targetForm = formname
    this.option = option
    this.cachedFileArray =[]
    this.currentFileCount = 0
    this.maxFileCount = 0
    this.groupnum = 1
    this.resizedFileArray =[]
    this.el = document.querySelector(`.mf-file-container[data-upload-id="${ formname }"]`)
    if(typeof option.maxFileCount !== 'undefined') this.maxFileCount = option.maxFileCount
    this.input = document.querySelector(`#${formname}`)

    this.addEvent()
  }
  addEvent(){
    const self = this
    self.input.addEventListener('change', function () {
          self.addFiles(this.files)
      }, true)

    $(this.el).on('click', '.mf-file-container__image-clear' ,(e) => {
      e.stopPropagation();
      self.clearfile(e.target)
    });
  }
  addFiles(files){
    const self = this
    if (files.length === 0) { return }

    let adjustedFilesLength = files.length
    if (self.maxFileCount > 0) {
        if ((files.length +self.cachedFileArray.length) > self.maxFileCount) {
            adjustedFilesLength = self.maxFileCount - self.cachedFileArray.length
        }
    }
    if ( self.option.maxFileperOnce > 0 && adjustedFilesLength > self.option.maxFileperOnce ){
      adjustedFilesLength = self.option.maxFileperOnce
    }
    for (let x = 0; x < adjustedFilesLength; x++) {
      const file = files[x]
      file.token = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15)
      file.groupnum = self.groupnum;
      self.cachedFileArray.push(file)
      const reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onload = (event) => {
          /*
          var prev = selectmoveingpreviewTemplate( {src:event.target.result, token:file.token, groupnum:self.groupnum} )
          $(self.input).closest('.upload-image-item-btn').after(prev)

          */
        }
        mfResizeImage({
            file: file,
            maxSize: self.option.maxSize
        }).then(function (resizedImage) {
            reader.onload = function(e){
                //document.getElementById('output').src = resizedImage;
            };
            reader.readAsDataURL(file);

            // resizing 이후 파일
            var resizedfile = new File( [resizedImage[0]] , self.groupnum+'_'+file.name +'.jpg' , {type:"image/jpeg", lastModified:new Date().getTime()});
            resizedfile.token = file.token
            resizedfile.groupnum = file.groupnum;
            self.resizedFileArray.push(resizedfile);

            var prev = selectmoveingpreviewTemplate( {src:resizedImage[1], token:file.token, groupnum:self.groupnum} )
            $(self.input).closest('.upload-image-item-btn').after(prev)
            if( x == adjustedFilesLength - 1 ) {
              self.groupnum ++
            }
        });
    }
  }

  clearfile(btn){
    const self = this
    if( !$(btn).hasClass('mf-file-container__image-clear') ) btn = $(btn).closest('.mf-file-container__image-clear')
    var preview = $(btn).closest('.upload-image-item');
    const fileToken = $(btn).data('token')

    var selectedFileIndex = self.cachedFileArray.findIndex(x => x.token === fileToken)
    if (!self.cachedFileArray[selectedFileIndex]) {
      throw new Error('There is no file at index', index)
    }
    self.cachedFileArray.splice(selectedFileIndex, 1)

    selectedFileIndex = self.resizedFileArray.findIndex(x => x.token === fileToken)
    if (!self.resizedFileArray[selectedFileIndex]) {
      throw new Error('There is no file at index', index)
    }
    self.resizedFileArray.splice(selectedFileIndex, 1)

    $(preview).remove();
  }
  getfiles(){
    return this.cachedFileArray
  }
  getCount(){
    return this.cachedFileArray.length
  }
  getResize() {
    return this.resizedFileArray
  }
  async getGroupedData() {
    var res ={}
    this.resizedFileArray.forEach(async (item) => {
      if( typeof res['group_'+item.groupnum] == 'undefined') res['group_'+item.groupnum] = new DataTransfer();
      res['group_'+item.groupnum].items.add(item)
    })
    return res
  }
  async setInputByResize( opt ){
  	//var $container = $('<div>', {class: 'image-uploader-container'});
    let iusettings = {
        target: '#image-uploader-container',
  	    prefixid: 'nfaceuploder',
  	    inputName: 'upload',
  	    extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
  	};
    if(typeof opt == 'object'){
      Object.assign(iusettings, opt);
    }
  	//var $container = $('<div>', {class: 'image-uploader-container'});
  	var $container = $(iusettings.target)

    var res ={}
    this.resizedFileArray.forEach(async (item) => {
      if( typeof res['group_'+item.groupnum] == 'undefined') res['group_'+item.groupnum] = new DataTransfer();
      res['group_'+item.groupnum].items.add(item)
    })

    var keys = Object.keys( res )
    keys.forEach(async (item) => {
      var $input = $('<input>', {
        type: 'file',
        id: iusettings.prefixid + '-' +  Math.random().toString(36).substring(2, 8) + Math.random().toString(36).substring(2, 8),
        name: iusettings.inputName + '[]',
        accept: iusettings.extensions.join(','),
        multiple: ''
      }).appendTo($container);
      $input.prop('files', res[item].files)
    } )
  }
}
