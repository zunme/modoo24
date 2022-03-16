<div>
  <div class="row">
  <div class="col-12 col-md-12">
    <div class="card">
      <div class="card-header">
        <h4>{{$start}}~{{$end}}</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <tbody><tr>
              <th>날짜</th>
              <th>Name</th>
              <th>CNT</th>
            </tr>
            @foreach( $data as $row)
            <tr>
              <td>{{$row->m}}</td>
              <td>{{$row->cafe_name}}</td>
              <td>{{$row->cnt}}</td>
            </tr>
            @endforeach
          </tbody></table>
        </div>
      </div>

    </div>
  </div>

</div>
