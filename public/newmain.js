/*
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="/community/assets/js/handlebars.js"></script>
	<!-- date picker -->
	<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ko.min.js" integrity="sha512-L4qpL1ZotXZLLe8Oo0ZyHrj/SweV7CieswUODAAPN/tnqN3PA1P+4qPu5vIryNor6HQ5o22NujIcAZIfyVXwbQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- sweetalert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- toast -->
	<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js" integrity="sha256-321PxS+POvbvWcIVoRZeRmf32q7fTFQJ21bXwTNWREY=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/community/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">
	<!-- swiper -->
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
	<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>	
	
	
	<link rel="stylesheet" href="/community/newmain.css" />
	<script src="/community/newmain.js"></script>
	*/


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
		// end 손없는날 
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
								position: 'center'
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
        position: 'center'
      });
    }
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
		
		
		
$("document").ready( function() {
	//달력
	var startMovingDate = new Date();
	var endMovingDate = new Date();
	var numberOfDaysStart = 0;
	var numberOfDaysEnd = 60;
	startMovingDate.setDate(startMovingDate.getDate() + numberOfDaysStart);
	endMovingDate.setDate(startMovingDate.getDate() + numberOfDaysEnd);

	$(".sel-datepicker").prop("readonly",true);
	$(".sel-datepicker").datepicker({
			format: "yyyy-mm-dd",
			language: "ko",
			startDate: startMovingDate,
			endDate:endMovingDate,
			todayHighlight: true,
			autoclose: true,
			//todayBtn: "linked",
			clearBtn: false,
			closeBtn: false,// close button visible
			forceParse: false,
			title : '..',
			beforeShowDay: function(date){
				let son =  solarToLunar( date.getFullYear() ,date.getMonth()+1, date.getDate(), true);
					//console.log ( date.getFullYear() +"-"+date.getMonth()+"-"+ date.getDate()+" : " + solarToLunar( date.getFullYear() ,date.getMonth(), date.getDate() ) )
				if( son ) {
					return {
								tooltip: '손없는날'+ date.getFullYear() +"-"+(date.getMonth()+1) +"-"+ date.getDate(),
								classes: 'son-active'
					}
				}

			},

	}).on('show', function(e) {
		$(".datepicker-title").html("<div class='div-sonclass'><span class='span-sonclass'></span><span class='span-sonclass-title'>손없는날</span></div>")
	});
	
	$(".btn_simply").on("click", function(e) {
		let btn = e.target
		simplyReg(btn);
	})
});
//간편이사견적
function simplyReg(btn) {
	loaderAttach("#simply_move")
	loaderAttach(".mobile > .message")
	let data = $(btn).closest("form").serialize();
	getData('post', 'simpyreg', data, simplyRegcallback, simplyRegcallbackCompltet)
}
function simplyRegcallback(res){
	Swal.fire({
		icon: 'success',
		title: '신청완료',
		text: '이사견적을 신청하였습니다.',
		footer: '<span class="simplyregSuccessFooter">모두이사</span>'
	})
	$("#simply_move").append('<div class="simplyregSuccessWrap"><div class="simplyregSuccessinner"><span>이사견적을 신청하였습니다.</span></div></div>')
	$(".mobile > .message").append('<div class="simplyregSuccessWrap"><div class="simplyregSuccessinner"><span>이사견적을 신청하였습니다.</span></div></div>')
}
function simplyRegcallbackCompltet() {
	loaderAttach("#simply_move", false)
	loaderAttach(".mobile > .message", false)
}
function loaderAttach(target,on) {
	if( on == false ){
		$(target).children(".loaderWrap").slideUp(500).remove()
		return;
	} 
	let loader = `<div class="loaderWrap" style="background-color: rgb(241 242 243 / 38%);"><div class="loaderWrapInner">
<svg style="    width: 100px;height: 100px;margin: auto;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(241, 242, 243); display: block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<rect x="17.5" y="30" width="15" height="40" fill="#1d3f72">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
</rect>
<rect x="42.5" y="30" width="15" height="40" fill="#5699d2">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
</rect>
<rect x="67.5" y="30" width="15" height="40" fill="#d8ebf9">
  <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
  <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
</rect>
</svg>
</div></div>
`
	$(target).append(loader);
}





// 이사후기
		// swiper 템플릿
let move_review_template =`
	<div class="swiper-wrapper">
		{{#each data}}
		<div class="swiper-slide move_review_item">
			<div data-id='{{b_uid}}' class="move_review_item_inner" onClick2="viewReview(this)">
				<div class="move_review_item_header">
					<h3>{{{s_company}}}</h3>
					<h4>({{company_point_title}})</h4>
				</div>
				<div class="move_review_item_star_wrap">
					<div class="move_review_item_star">
						<img src="http://116.122.157.150:8084/NEW/image/main_N/big_star.png" alt="star">
					</div>
					<div class="move_review_item_point_wrap">
						<div class="move_review_item_point">
							{{avg}}
						</div>
						<div class="move_review_item_point_desc">
							전체 누적 평점
						</div>
					</div>
				</div>
				<div class="move_review_item_txt">
					{{{b_note}}}
				</div>
				<div class="move_review_item_date">
					이사일 2020-11-20
				</div>								
			</div>
		</div>
	{{/each}}
	</div>
`
		// 팝업 템플릿
let move_modal_default_template=`
<div class="modal" tabindex="-1" role="dialog" id="detailModal">
  <div class="modal-dialog" id="detailModal_content" role="document">
	</div>
</div>
`
let move_review_detail_template=`
    <div class="modal-content">
      <div class="modal-header">
        <div>
					<div>
						이사일 2021-09-21
					</div>
					
					<button type="button" class="close abs-top" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					
				</div>
      </div>
      <div class="modal-body">
        	<div>
						<span class="modal-review-company-title">[{{company_point_title}}]</span>
						<span class="modal-review-company">{{s_company}}</span>
					</div>
					<div class="modal-review-star_wrap">
						{{#each avgstararr}}
							{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
							{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
							{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
						{{/each}}
						<span class="modal-review-point-total">{{avg}}</span>
					</div>
				
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">전문성</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_pro_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">친절성</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_kind_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>								
							</div>
						</div>
					</div>
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">가격도</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_price_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">마무리</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_finish_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>								
							</div>
						</div>
					</div>
					<div class="row modal-review-points_wrap">
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">사후관리</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_expost_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row modal-review-point-row_wrap">
								<div class="s-col modal-review-point-row-title">포장도</div>
								<div class="s-col modal-review-point-row-pointwrap">
									{{#each b_star_pave_arr}}
										{{#if ( isEqual this '1' ) }}<i class="fas fa-star"></i>{{/if}}
										{{#if ( isEqual this '0.5' ) }}<i class="fas fa-star-half-alt"></i>{{/if}}
										{{#if ( isEqual this '0' ) }}<i class="far fa-star"></i>{{/if}}
									{{/each}}
								</div>								
							</div>
						</div>
					</div>
				
				<div class="modal-review-contents-wrap">
					<div class="modal-review-contents">
						{{{b_note}}}
					</div>
				</div>
				
      </div>
			
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
      </div>
    </div>
`;
let move_review_info;
let good_ct_after_swiper;
$("document").ready( function(){
	///community/api/movereview
	$(".crsl-items").remove()
	$(".center.event_wrap").html( event_template );
	$(".good_ct_after > .center").append('<div class="" id="move_review_slider"><div class="swiper-button-next"></div><div class="swiper-button-prev"></div></div>')
	$("body").append(move_modal_default_template)
	getData('get', 'movereview', {}, swipertemplate)
	$('#detailModal').on('hidden.bs.modal', function () {
			good_ct_after_swiper.autoplay.start()
		console.log ( "close")
	});
})
function swipertemplate(res){
	var template = Handlebars.compile( move_review_template );
	$("#move_review_slider" ).prepend( template(res) );
	move_review_info = res.data;
	derawswiper();
}
function derawswiper() {
	good_ct_after_swiper = new Swiper("#move_review_slider", {
			preventClicks:false,
			slidesPerView: 2,
			//slidesPerView: "auto",
			centeredSlides: false,
      spaceBetween: 14,
      freeMode: true,
			autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },
			breakpoints: {
				100: {
					slidesPerView: 2,
					spaceBetween: 20
				},
				680: {
					slidesPerView: 3,
					spaceBetween: 16
				},
				850: {
					slidesPerView: 4,
					spaceBetween: 14
				},
			},
		loop: true,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			on:{
				click: function(swiper, event){
					let id = $(event.target).closest('.move_review_item_inner').data('id');
					move_review_info.forEach( function ( row, idx) { 
						if( row['b_uid'] == id ) viewReviewTemplate( row );
					})
				},				
			}
	});		
}
function viewReview(btn){
	let id = $(btn).data('id')
	move_review_info.forEach( function ( row, idx) { 
		if( row['b_uid'] == id ) viewReviewTemplate( row );
	})
}
function viewReviewTemplate( data){
	move_review_detail_template
	
	var template = Handlebars.compile( move_review_detail_template );
	$("#detailModal_content" ).html( template(data) );
	$('#detailModal').modal('show');
	good_ct_after_swiper.autoplay.stop()
}
// end 칭찬후기 

//event swiper
let event_template =`
			<div id="event_swiper" style="position:relative;">
				<div class="swiper-wrapper">
              <div class="swiper-slide">
                    <a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
                        <img class="d-block w-100 pc" src="/NEW/image/main_N/event_210923.jpg" class="pc" alt="황금열쇠이벤트">
                        <img class="d-block w-100 mobile" src="/NEW/image/main_N/event_210923_m.jpg" class="pc" alt="황금열쇠이벤트">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://blog.naver.com/modoo24try/222488994124" target="_blank">
                        <img class="d-block w-100 pc" src="/NEW/image/main_N/event_ss.jpg" class="pc" alt="삼성이벤트">
                        <img class="d-block w-100 mobile" src="/NEW/image/main_N/event_ss_m.jpg" class="pc" alt="삼성이벤트">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://www.internetfriends.co.kr/index.php?s1=modoo24_event&action=reg&utm_source=modoo24&utm_medium=partner&utm_campaign=landing&utm_content=modoo24-2021-01-22" target="_blank">
                        <img class="d-block w-100 pc" src="/NEW/image/main_N/event_it.jpg" class="pc" alt="인터넷신청">
                        <img class="d-block w-100 mobile" src="/NEW/image/main_N/event_it_m.jpg" class="pc" alt="인터넷신청">
                    </a>
                </div>
				</div>
				
					<div class="swiper-button-next"></div>
      		<div class="swiper-button-prev"></div>
				<div class="swiper-pagination"></div>
			</div>
`
$("document").ready( function(){
	$("nav.slidernav").remove()
	new Swiper("#event_swiper", {
			slidesPerView: 1,
			spaceBetween:10,
			freeMode: false,
		loop: true,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
		pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
		autoHeight: true,
	})
})

<!-- /event -->
