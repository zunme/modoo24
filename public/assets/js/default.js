Handlebars.registerHelper('nl2br', function(text) {
  text = Handlebars.Utils.escapeExpression(text);
  text = text.replace(/(\r\n|\n|\r)/gm, '<br>');
  return new Handlebars.SafeString(text);
});
Handlebars.registerHelper('encodeMyString',function(inputData){
    return new Handlebars.SafeString(inputData);
});
Handlebars.registerHelper('isEqual', function (expectedValue, value) {
  return value === expectedValue;
});
Handlebars.registerHelper('isNotEqual', function (expectedValue, value) {
  return value !== expectedValue;
});
Handlebars.registerHelper('checkempty', function(value) {
    if ( typeof value == 'undefined') return true;
    if ( typeof value == 'string') value = value.trim();
    if (value === null) return true;
    else if (value === '') return true;
    else return false;
});
Handlebars.registerHelper('checknotempty', function(value) {
    if ( typeof value == 'undefined') return false;
    if ( typeof value == 'string') value = value.trim();
    if (value === null) return false;
    else if (value === '') return false;
    else return true;
});
Handlebars.registerHelper('gt', function(a, b) {
  return (a > b);
});
Handlebars.registerHelper('gte', function(a, b) {
  return (a >= b);
});
Handlebars.registerHelper('lt', function(a, b) {
  return (a < b);
});
Handlebars.registerHelper('lte', function(a, b) {
  return (a <= b);
});
Handlebars.registerHelper('ne', function(a, b) {
  return (a !== b);
});

const LUNAR_LAST_YEAR = 1939;
        var lunarMonthTable = [
            [2, 2, 1, 1, 2, 1, 1, 2, 1, 2, 1, 2],   /* 양력 1940년 1월은 음력 1939년에 있음 그래서 시작년도는 1939년*/
            [2, 2, 1, 2, 1, 2, 1, 1, 2, 1, 2, 1],
            [2, 2, 1, 2, 2, 4, 1, 1, 2, 1, 2, 1],   /* 1941 */
            [2, 1, 2, 2, 1, 2, 2, 1, 2, 1, 1, 2],
            [1, 2, 1, 2, 1, 2, 2, 1, 2, 2, 1, 2],
            [1, 1, 2, 4, 1, 2, 1, 2, 2, 1, 2, 2],
            [1, 1, 2, 1, 1, 2, 1, 2, 2, 2, 1, 2],
            [2, 1, 1, 2, 1, 1, 2, 1, 2, 2, 1, 2],
            [2, 5, 1, 2, 1, 1, 2, 1, 2, 1, 2, 2],
            [2, 1, 2, 1, 2, 1, 1, 2, 1, 2, 1, 2],
            [2, 2, 1, 2, 1, 2, 3, 2, 1, 2, 1, 2],
            [2, 1, 2, 2, 1, 2, 1, 1, 2, 1, 2, 1],
            [2, 1, 2, 2, 1, 2, 1, 2, 1, 2, 1, 2],   /* 1951 */
            [1, 2, 1, 2, 4, 2, 1, 2, 1, 2, 1, 2],
            [1, 2, 1, 1, 2, 2, 1, 2, 2, 1, 2, 2],
            [1, 1, 2, 1, 1, 2, 1, 2, 2, 1, 2, 2],
            [2, 1, 4, 1, 1, 2, 1, 2, 1, 2, 2, 2],
            [1, 2, 1, 2, 1, 1, 2, 1, 2, 1, 2, 2],
            [2, 1, 2, 1, 2, 1, 1, 5, 2, 1, 2, 2],
            [1, 2, 2, 1, 2, 1, 1, 2, 1, 2, 1, 2],
            [1, 2, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1],
            [2, 1, 2, 1, 2, 5, 2, 1, 2, 1, 2, 1],
            [2, 1, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2],   /* 1961 */
            [1, 2, 1, 1, 2, 1, 2, 2, 1, 2, 2, 1],
            [2, 1, 2, 3, 2, 1, 2, 1, 2, 2, 2, 1],
            [2, 1, 2, 1, 1, 2, 1, 2, 1, 2, 2, 2],
            [1, 2, 1, 2, 1, 1, 2, 1, 1, 2, 2, 2],
            [1, 2, 5, 2, 1, 1, 2, 1, 1, 2, 2, 1],
            [2, 2, 1, 2, 2, 1, 1, 2, 1, 2, 1, 2],
            [1, 2, 2, 1, 2, 1, 5, 2, 1, 2, 1, 2],
            [1, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2, 1],
            [2, 1, 1, 2, 2, 1, 2, 1, 2, 2, 1, 2],
            [1, 2, 1, 1, 5, 2, 1, 2, 2, 2, 1, 2],   /* 1971 */
            [1, 2, 1, 1, 2, 1, 2, 1, 2, 2, 2, 1],
            [2, 1, 2, 1, 1, 2, 1, 1, 2, 2, 2, 1],
            [2, 2, 1, 5, 1, 2, 1, 1, 2, 2, 1, 2],
            [2, 2, 1, 2, 1, 1, 2, 1, 1, 2, 1, 2],
            [2, 2, 1, 2, 1, 2, 1, 5, 2, 1, 1, 2],
            [2, 1, 2, 2, 1, 2, 1, 2, 1, 2, 1, 1],
            [2, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2, 1],
            [2, 1, 1, 2, 1, 6, 1, 2, 2, 1, 2, 1],
            [2, 1, 1, 2, 1, 2, 1, 2, 2, 1, 2, 2],
            [1, 2, 1, 1, 2, 1, 1, 2, 2, 1, 2, 2],   /* 1981 */
            [2, 1, 2, 3, 2, 1, 1, 2, 2, 1, 2, 2],
            [2, 1, 2, 1, 1, 2, 1, 1, 2, 1, 2, 2],
            [2, 1, 2, 2, 1, 1, 2, 1, 1, 5, 2, 2],
            [1, 2, 2, 1, 2, 1, 2, 1, 1, 2, 1, 2],
            [1, 2, 2, 1, 2, 2, 1, 2, 1, 2, 1, 1],
            [2, 1, 2, 2, 1, 5, 2, 2, 1, 2, 1, 2],
            [1, 1, 2, 1, 2, 1, 2, 2, 1, 2, 2, 1],
            [2, 1, 1, 2, 1, 2, 1, 2, 2, 1, 2, 2],
            [1, 2, 1, 1, 5, 1, 2, 1, 2, 2, 2, 2],
            [1, 2, 1, 1, 2, 1, 1, 2, 1, 2, 2, 2],   /* 1991 */
            [1, 2, 2, 1, 1, 2, 1, 1, 2, 1, 2, 2],
            [1, 2, 5, 2, 1, 2, 1, 1, 2, 1, 2, 1],
            [2, 2, 2, 1, 2, 1, 2, 1, 1, 2, 1, 2],
            [1, 2, 2, 1, 2, 2, 1, 5, 2, 1, 1, 2],
            [1, 2, 1, 2, 2, 1, 2, 1, 2, 2, 1, 2],
            [1, 1, 2, 1, 2, 1, 2, 2, 1, 2, 2, 1],
            [2, 1, 1, 2, 3, 2, 2, 1, 2, 2, 2, 1],
            [2, 1, 1, 2, 1, 1, 2, 1, 2, 2, 2, 1],
            [2, 2, 1, 1, 2, 1, 1, 2, 1, 2, 2, 1],
            [2, 2, 2, 3, 2, 1, 1, 2, 1, 2, 1, 2],   /* 2001 */
            [2, 2, 1, 2, 1, 2, 1, 1, 2, 1, 2, 1],
            [2, 2, 1, 2, 2, 1, 2, 1, 1, 2, 1, 2],
            [1, 5, 2, 2, 1, 2, 1, 2, 1, 2, 1, 2],
            [1, 2, 1, 2, 1, 2, 2, 1, 2, 2, 1, 1],
            [2, 1, 2, 1, 2, 1, 5, 2, 2, 1, 2, 2],
            [1, 1, 2, 1, 1, 2, 1, 2, 2, 2, 1, 2],
            [2, 1, 1, 2, 1, 1, 2, 1, 2, 2, 1, 2],
            [2, 2, 1, 1, 5, 1, 2, 1, 2, 1, 2, 2],
            [2, 1, 2, 1, 2, 1, 1, 2, 1, 2, 1, 2],
            [2, 1, 2, 2, 1, 2, 1, 1, 2, 1, 2, 1],   /* 2011 */
            [2, 1, 6, 2, 1, 2, 1, 1, 2, 1, 2, 1],
            [2, 1, 2, 2, 1, 2, 1, 2, 1, 2, 1, 2],
            [1, 2, 1, 2, 1, 2, 1, 2, 5, 2, 1, 2],
            [1, 2, 1, 1, 2, 1, 2, 2, 2, 1, 2, 1],
            [2, 1, 2, 1, 1, 2, 1, 2, 2, 1, 2, 2],
            [2, 1, 1, 2, 3, 2, 1, 2, 1, 2, 2, 2],
            [1, 2, 1, 2, 1, 1, 2, 1, 2, 1, 2, 2],
            [2, 1, 2, 1, 2, 1, 1, 2, 1, 2, 1, 2],
            [2, 1, 2, 5, 2, 1, 1, 2, 1, 2, 1, 2],
            [1, 2, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1],   /* 2021 */
            [2, 1, 2, 1, 2, 2, 1, 2, 1, 2, 1, 2],
            [1, 5, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2],
            [1, 2, 1, 1, 2, 1, 2, 2, 1, 2, 2, 1],
            [2, 1, 2, 1, 1, 5, 2, 1, 2, 2, 2, 1],
            [2, 1, 2, 1, 1, 2, 1, 2, 1, 2, 2, 2],
            [1, 2, 1, 2, 1, 1, 2, 1, 1, 2, 2, 2],
            [1, 2, 2, 1, 5, 1, 2, 1, 1, 2, 2, 1],
            [2, 2, 1, 2, 2, 1, 1, 2, 1, 1, 2, 2],
            [1, 2, 1, 2, 2, 1, 2, 1, 2, 1, 2, 1],
            [2, 1, 5, 2, 1, 2, 2, 1, 2, 1, 2, 1],   /* 2031 */
            [2, 1, 1, 2, 1, 2, 2, 1, 2, 2, 1, 2],
            [1, 2, 1, 1, 2, 1, 2, 1, 2, 2, 5, 2],
            [1, 2, 1, 1, 2, 1, 2, 1, 2, 2, 2, 1],
            [2, 1, 2, 1, 1, 2, 1, 1, 2, 2, 1, 2],
            [2, 2, 1, 2, 1, 4, 1, 1, 2, 2, 1, 2],
            [2, 2, 1, 2, 1, 1, 2, 1, 1, 2, 1, 2],
            [2, 2, 1, 2, 1, 2, 1, 2, 1, 1, 2, 1],
            [2, 2, 1, 2, 5, 2, 1, 2, 1, 2, 1, 1],
            [2, 1, 2, 2, 1, 2, 2, 1, 2, 1, 2, 1],
            [2, 1, 1, 2, 1, 2, 2, 1, 2, 2, 1, 2],   /* 2041 */
            [1, 5, 1, 2, 1, 2, 1, 2, 2, 2, 1, 2],
            [1, 2, 1, 1, 2, 1, 1, 2, 2, 1, 2, 2]];

// 음력 계산을 위한 객체
function myDate(year, month, day, leapMonth) {
    this.year = year;
    this.month = month;
    this.day = day;
    this.leapMonth = leapMonth;
}

// 양력을 음력으로 계산
function lunarCalc(year, month, day, type, leapmonth) {
    var solYear, solMonth, solDay;
    var lunYear, lunMonth, lunDay;

    // lunLeapMonth는 음력의 윤달인지 아닌지를 확인하기위한 변수
    // 1일 경우 윤달이고 0일 경우 음달
    var lunLeapMonth, lunMonthDay;
    var i, lunIndex;

    var solMonthDay = [31, 0, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    /* range check */
    if (year < 1940 || year > 2040) {
        alert('1940년부터 2040년까지만 지원합니다');
        return;
    }

    /* 속도 개선을 위해 기준 일자를 여러개로 한다 */
    if (year >= 2000) {
        /* 기준일자 양력 2000년 1월 1일 (음력 1999년 11월 25일) */
        solYear = 2000;
        solMonth = 1;
        solDay = 1;
        lunYear = 1999;
        lunMonth = 11;
        lunDay = 25;
        lunLeapMonth = 0;

        solMonthDay[1] = 29;    /* 2000 년 2월 28일 */
        lunMonthDay = 30;   /* 1999년 11월 */
    }
    else if (year >= 1970) {
        /* 기준일자 양력 1970년 1월 1일 (음력 1969년 11월 24일) */
        solYear = 1970;
        solMonth = 1;
        solDay = 1;
        lunYear = 1969;
        lunMonth = 11;
        lunDay = 24;
        lunLeapMonth = 0;

        solMonthDay[1] = 28;    /* 1970 년 2월 28일 */
        lunMonthDay = 30;   /* 1969년 11월 */
    }
    else {
        /* 기준일자 양력 1940년 1월 1일 (음력 1939년 11월 22일) */
        solYear = 1940;
        solMonth = 1;
        solDay = 1;
        lunYear = 1939;
        lunMonth = 11;
        lunDay = 22;
        lunLeapMonth = 0;

        solMonthDay[1] = 29;    /* 1940 년 2월 28일 */
        lunMonthDay = 29;   /* 1939년 11월 */
    }

    lunIndex = lunYear - LUNAR_LAST_YEAR;

    // type이 1일때는 입력받은 양력 값에 대한 음력값을 반환
    // 2일 때는 입력받은 음력 값에 대한 양력값을 반환
    // 반복문이 돌면서 양력 값들과 음력 값들을 1일 씩 증가시키고
    // 입력받은 날짜값과 양력 값이 일치할 때 음력값을 반환함
    while (true) {
        if (type == 1 &&
            year == solYear &&
            month == solMonth &&
            day == solDay) {
            return new myDate(lunYear, lunMonth, lunDay, lunLeapMonth);
        }
        else if (type == 2 &&
            year == lunYear &&
            month == lunMonth &&
            day == lunDay &&
            leapmonth == lunLeapMonth) {
            return new myDate(solYear, solMonth, solDay, 0);
        }

        // 양력의 마지막 날일 경우 년도를 증가시키고 나머지 초기화
        if (solMonth == 12 && solDay == 31) {
            solYear++;
            solMonth = 1;
            solDay = 1;

            // 윤년일 시 2월달의 총 일수를 1일 증가
            if (solYear % 400 == 0)
                solMonthDay[1] = 29;
            else if (solYear % 100 == 0)
                solMonthDay[1] = 28;
            else if (solYear % 4 == 0)
                solMonthDay[1] = 29;
            else
                solMonthDay[1] = 28;

        }
        // 현재 날짜가 달의 마지막 날짜를 가리키고 있을 시 달을 증가시키고 날짜 1로 초기화
        else if (solMonthDay[solMonth - 1] == solDay) {
            solMonth++;
            solDay = 1;
        }
        else
            solDay++;

        // 음력의 마지막 날인 경우 년도를 증가시키고 달과 일수를 초기화
        if (lunMonth == 12 &&
            ((lunarMonthTable[lunIndex][lunMonth - 1] == 1 && lunDay == 29) ||
                (lunarMonthTable[lunIndex][lunMonth - 1] == 2 && lunDay == 30))) {
            lunYear++;
            lunMonth = 1;
            lunDay = 1;

            if (lunYear > 2043) {
                alert("입력하신 달은 없습니다.");
                break;
            }

            // 년도가 바꼈으니 index값 수정
            lunIndex = lunYear - LUNAR_LAST_YEAR;

            // 음력의 1월에는 1 or 2만 있으므로 1과 2만 비교하면됨
            if (lunarMonthTable[lunIndex][lunMonth - 1] == 1)
                lunMonthDay = 29;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 2)
                lunMonthDay = 30;
        }
        // 현재날짜가 이번달의 마지막날짜와 일치할 경우
        else if (lunDay == lunMonthDay) {

            // 윤달인데 윤달계산을 안했을 경우 달의 숫자는 증가시키면 안됨
            if (lunarMonthTable[lunIndex][lunMonth - 1] >= 3
                && lunLeapMonth == 0) {
                lunDay = 1;
                lunLeapMonth = 1;
            }
            // 음달이거나 윤달을 계산 했을 겨우 달을 증가시키고 lunLeapMonth값 초기화
            else {
                lunMonth++;
                lunDay = 1;
                lunLeapMonth = 0;
            }

            // 음력의 달에 맞는 마지막날짜 초기화
            if (lunarMonthTable[lunIndex][lunMonth - 1] == 1)
                lunMonthDay = 29;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 2)
                lunMonthDay = 30;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 3)
                lunMonthDay = 29;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 4 &&
                lunLeapMonth == 0)
                lunMonthDay = 29;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 4 &&
                lunLeapMonth == 1)
                lunMonthDay = 30;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 5 &&
                lunLeapMonth == 0)
                lunMonthDay = 30;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 5 &&
                lunLeapMonth == 1)
                lunMonthDay = 29;
            else if (lunarMonthTable[lunIndex][lunMonth - 1] == 6)
                lunMonthDay = 30;
        }
        else
            lunDay++;
    }
}

// 양력을 음력날짜로 변환
function solarToLunar(solYear, solMonth, solDay, son ) {
    // 날짜 형식이 안맞을 경우 공백 반환
    if (!solYear || solYear == 0 ||
        !solMonth || solMonth == 0 ||
        !solDay || solDay == 0) {
        return "";
    }

    // 양력의 달마다의 일수
    var solMonthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    // 윤년일 시 2월에 1일 추가
    if (solYear % 400 == 0 || (solYear % 4 == 0 && solYear % 100 != 0)) solMonthDays[1] += 1;


    if (solMonth < 1 || solMonth > 12 ||
        solDay < 1 || solDay > solMonthDays[solMonth - 1]) {

        return "";
    }

    /* 양력/음력 변환 */
    var date = lunarCalc(solYear, solMonth, solDay, 1);

		if (son){
			let sonstr =''
			let str = date.day.toString();
			let last_char = str.charAt(str.length-1);
			if( last_char =='0' || last_char =='9' ) {
				return true;
				sonstr = last_char;
			}
			else return false
		}

    return "음력 " + date.year + "년 " + (date.leapMonth ? "(윤)" : "") + date.month + "월 " + date.day;
}




  var totalImgCnt = 0;
  var inpCnt = 0;

  var lang_kor = {
    "decimal" : "",
    "emptyTable" : "데이터가 없습니다.",
    "info" : "_START_ - _END_ (총 _TOTAL_ 개)",
    "infoEmpty" : "0 개",
    "infoFiltered" : "(전체 _MAX_ 명 중 검색결과)",
    "infoPostFix" : "",
    "thousands" : ",",
    "lengthMenu" : "_MENU_ 개씩 보기",
    "loadingRecords" : "로딩중...",
    "processing" : "WAIT...",
    "search" : "검색 : ",
    "zeroRecords" : "검색된 데이터가 없습니다.",
    "paginate" : {
        "first" : "첫 페이지",
        "last" : "마지막 페이지",
        "next" : "다음",
        "previous" : "이전"
      },
    "aria" : {
        "sortAscending" : " :  오름차순 정렬",
        "sortDescending" : " :  내림차순 정렬"
      }
  };

  function readURL(input, id) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var filename = $(input).val();
      filename = filename.substring(filename.lastIndexOf('\\')+1);
      reader.onload = function(e) {
        if(e.total >  1024*300 ) {
          $('#'+id+'_col').remove();
          Swal.fire({
            title : '파일사이즈',
            text: '300Kb 까지만 업로드가 가능합니다.',
            icon: 'error',
            confirmButtonText: '확인'
          })
          return;
          //메가 1048576
        }
        var bytes = formatBytes( e.total);

        $('#'+id+'_preview').attr('src', e.target.result);

        $('#'+id+'_preview').hide();
        $('#'+id+'_preview').parent().removeClass('hide');

        $('#'+id+'_preview').fadeIn(500);
        $('#'+id+'_preview').show();
        $('#'+id+'_byte').text(bytes)
        $('#'+id+'_filename').text(filename)
        $('#'+id+'_col').removeClass('hide');
        totalImgCnt++;
      }
      reader.readAsDataURL(input.files[0]);
    }
    //$(".alert").removeClass("loading").hide();
  }
  function removeFile(btn){
    var row = $(btn).closest('.imgprevcol');
    $(row).fadeOut(500, function (){
      $(row).remove();
      totalImgCnt--;
    });
  }
  function formatBytes(bytes, decimals = 2) {
      if (bytes === 0) return '0 Bytes';

      const k = 1024;
      const dm = decimals < 0 ? 0 : decimals;
      const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

      const i = Math.floor(Math.log(bytes) / Math.log(k));

      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
  }
  function loginpopform() {
      Swal.fire({
        title: '기획후 작성예정',
        text: 'AJAX LOGIN - EMAIL ID',
        icon: 'info',
        confirmButtonText: '확인'
      })
  }
  function logout(){
$.ajax({
  url : '/community/refresh',
  method:"get",
  dataType:'JSON',
  success:function(result){
    $('meta[name="csrf-token"]').attr('content', result.token);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': result.token
          }
      });

      $.ajax({
        url: '/community/logout',
        method:"POST",
        data: {"_token" : result.token } ,
        success:function(res)
        {
          console.log (res)
        },
        error: function ( err ){
          ajaxErrorST(err)
        },
        complete : function(){
          location.replace('/');
        }
      });

  } // end success
});
  }


function ajaxErrorST(jqXHR ){
$('.loading_wrap').hide();
if(jqXHR.status != 422 && jqXHR.status != 500 ) {
  iziToast.error({
      message: '잠시후에 이용해주세요',
      position: 'bottomRight'
  });
  return;
}

var msg ;
var exception ;
if (jqXHR.responseJSON ) {
  msg = (jqXHR.responseJSON.errors) ? jqXHR.responseJSON.errors : jqXHR.responseJSON;
  exception = jqXHR.responseJSON.exception;
}
console.log(msg) ;

  if(msg) {
    if( msg.message ){
      iziToast.error({
        message:  msg.message,
        position: 'center'
      });
    }else {
      for(key in msg) {
        if(msg.hasOwnProperty(key)) {
          if(key.indexOf('.') < 0 ) {
            $('input[name='+key+']').focus();
          }
          if ( $.isNumeric( key )) {
            iziToast.error({
              message: msg,
              position: 'center',
            });
          } else {
            iziToast.error({
              message: msg[key][0],
              position: 'center'
            });
          }
          break;
        }
      }
    }
  } else {
    iziToast.error({
      message: '시스템 오류입니다',
      position: 'bottomRight'
    });
  }
}
function pop_tpl( size, id , data, title ){
if ( typeof id =='undefined') return false;
var availsize = ['sm', 'lg', 'xl']
if ( !availsize.includes(size) ) size='default';
var template = Handlebars.compile( $( "#"+id ).html() );
$("#modal_"+size+"_body" ).html ( template(data) );
$( "#"+size+"Modal" ).modal('handleUpdate')
$( "#"+size+"Modal" ).modal('show')
if($(".datetimepicker").length) {
  $('.datetimepicker').daterangepicker({
      locale: {format: 'YYYY-MM-DD HH:mm'},
      singleDatePicker: true,
      timePicker: true,
      timePicker24Hour: true,
    });
}
}
// onClick="default_form_prc({'form':'updateform', 'url':'/adm/rooms/save','reload':datatable})"
function default_form_prc(info) {
var msg = ( typeof info.msg =='undefined') ? '정상적으로 처리되었습니다.' : info.msg;
$.ajax({
  url : '/adm/refresh',
  method:"get",
  dataType:'JSON',
  success:function(result){
    $('meta[name="csrf-token"]').attr('content', result.token);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': result.token
          }
      });
      $.ajax({
        url:info.url,
        method:"POST",
        data:new FormData( document.getElementById(info.form) ),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(res)
        {
          if( res.result =='error'){
            iziToast.success({
              message: res.msg,
              position: 'topRight'
            });
            return;
          } else {
            iziToast.success({
              message: msg,
              position: 'topRight'
            });
          }
          if( typeof info.reload !='undefined')   {
              if ( info.reload=="self"){
                location.reload();
              } else info.reload.ajax.reload(null, false);
            }
          $('.modal.show').modal('hide');
        },
        error: function ( err ){
          ajaxErrorST(err)
        }
      });
  }
});
}
function default_form_delete( info ){
let title='';
if (typeof info.title != 'undefined') title = `[${info.title}] 을(를) 삭제합니다.`;
swal.fire({
    title: '삭제하시겠습니까?',
    text : title,
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
         url: info.url,
         method:"POST",
         data:{delete_id: info.id },
         dataType:'JSON',
         success:function(res)
         {
           if( res.result =='error'){
             iziToast.success({
               message: res.msg,
               position: 'topRight'
             });
             return;
           } else {
             iziToast.success({
               message: '삭제되었습니다.',
               position: 'topRight'
             });
           }
           if( typeof info.reload !='undefined')   info.reload.ajax.reload(null, false);
        },
         error: function ( err ){
           ajaxErrorST(err)
         }
       });
    } else {
    swal.fire('취소되었습니다.');
    }
  });
}
  /* getpost */
function getpost( url,data , callbackSuccess, callbackCompleted ){
  $.ajax({
            url : '/community/refresh',
            method:"get",
            dataType:'JSON',
            success:function(result){
              $('meta[name="csrf-token"]').attr('content', result.token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': result.token
                    }
                });

                $.ajax({
                  url: url,
                  method:"POST",
                  data: data ,
                  dataType:'JSON',
                  success:function(res)
                  {
                    callbackSuccess(res)
                  },
                  error: function ( err ){
                    ajaxErrorST(err)
                  },
                  complete : function() {
                    if ( typeof callbackCompleted != 'undefined') callbackCompleted();
                  }
                });
            }, // end success

          });
}
function getData(method, url, data, callback, callbackCompltet){
	$.ajax({
		url : '/community/refresh',
		method:"get",
		dataType:'JSON',
		success:function(result){
			$('meta[name="csrf-token"]').attr('content', result.token);
			$.ajaxSetup({
					headers: {
							'X-CSRF-TOKEN': result.token
					}
			});

			$.ajax({
				url : '/community/api/'+ url,
				method:method,
				dataType:'JSON',
				data : data ,
				success:function(res){
					callback( res)
				},
				error: function ( err ){
				 ajaxErrorST(err)
				},
				complete:function() {
					if ( typeof callbackCompltet != 'undefined') callbackCompltet();
				}
			});

		}
	});
}
