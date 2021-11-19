<fieldset class="rating-half" data-ratingtype="b_star_{{$ratingType}}">
   <input type="radio" class="rating-radio-half" id="star5-{{$ratingType}}" name="rating-{{$ratingType}}" value="5" /><label class = "full-star" for="star5-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star4half-{{$ratingType}}" name="rating-{{$ratingType}}" value="4 and a half" /><label class="half-star" for="star4half-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star4-{{$ratingType}}" name="rating-{{$ratingType}}" value="4" /><label class = "full-star" for="star4-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star3half-{{$ratingType}}" name="rating-{{$ratingType}}" value="3 and a half" /><label class="half-star" for="star3half-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star3-{{$ratingType}}" name="rating-{{$ratingType}}" value="3" /><label class = "full-star" for="star3-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star2half-{{$ratingType}}" name="rating-{{$ratingType}}" value="2 and a half" /><label class="half-star" for="star2half-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star2-{{$ratingType}}" name="rating-{{$ratingType}}" value="2" /><label class = "full-star" for="star2-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star1half-{{$ratingType}}" name="rating-{{$ratingType}}" value="1 and a half" /><label class="half-star" for="star1half-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="star1-{{$ratingType}}" name="rating-{{$ratingType}}" value="1" /><label class = "full-star" for="star1-{{$ratingType}}"></label>
   <input type="radio" class="rating-radio-half" id="starhalf-{{$ratingType}}" name="rating-{{$ratingType}}" value="half" /><label class="half-star" for="starhalf-{{$ratingType}}"></label>
</fieldset>
<!--
<style>
.rating-half {
  border: none;
  float: left;
}

.rating-half > input { display: none; }
.rating-half > label:before {
  margin: 5px;
  font-size: 33px;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating-half > .half-star:before {
  content: "\f089";
  position: absolute;
}

.rating-half > label {
  color: #E1E6F6;
 float: right;
}
.rating-half > label.full-star{
  text-shadow: 3px 4px 5px rgb(0 0 0 / 30%);
}
.rating-half > input:checked ~ label,
.rating-half:not(:checked) > label:hover,
.rating-half:not(:checked) > label:hover ~ label { color: #34AC9E;  }

.rating-half > input:checked + label:hover,
.rating-half > input:checked ~ label:hover,
.rating-half > label:hover ~ input:checked ~ label,
.rating-half > input:checked ~ label:hover ~ label { color: #34AC9E;  }
</style>
-->
