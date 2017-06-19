<!DOCTYPE html>
<html>
<head>
	<title>intercoolerJs</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')}}">
		<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
		
	  	<script type="text/javascript" src="{{ asset('js/intercooler-1.1.2.js')}}"></script>
      
</head>
<body>
 {{--  <button ic-action = "fadeOut;remove" type="button" class="btn" href="">Click me!</button>
  <button ic-post-to = "/target_url" ic-indicator="#indicator" type="button" class="btn btn-default">Indicator</button>

  <i id="indicator" class="ic-indicator fa fa-spinner fa-spin ic-transition" ></i> --}}

   
    <form action="{{url('blank/store')}}" method="POST" role="form">
    {{csrf_field()}}
    
      <legend>Form title</legend>
    
      <div class="form-group @if ($errors->has('my')) has-error @endif">
        <label for="">label</label>
        <input name="my" type="text" class="form-control" id="" placeholder="Input field">

        {!!$errors->first('my','<span class="help-block">:message</span>')!!}
      </div>
    
      
    
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

   <div class="btn-group" ic-indicator="#indicator" ic-include="#checked-contacts" ic-target="#contactTableBody">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      Bulk Actions <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a ic-post-to="/activate">Activate</a></li>
      <li><a ic-post-to="/deactivate">Deactivate</a></li>
    </ul>
  </div>
  <i class="fa fa-spinner fa-spin" id="indicator" style="display:none"></i>

  <form id="checked-contacts">
    <table class="table">
      <thead>
      <tr>
        <th></th>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody id="contactTableBody">
      <tr>
        <td><input type="checkbox" name="ids" value="0"></td><td>Joe Smith</td><td>joe@smith.org</td><td>Active</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="ids" value="1"></td><td>Angie MacDowell</td><td>angie@macdowell.org</td><td>Active</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="ids" value="2"></td><td>Fuqua Tarkenton</td><td>fuqua@tarkenton.org</td><td>Active</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="ids" value="3"></td><td>Kim Yee</td><td>kim@yee.org</td><td>Inactive</td>
      </tr>
      </tbody>
    </table>
  </form>

  <style scoped="">
    .ic-transitioning tr.deactivate td {
      background: lightcoral;
    }
    .ic-transitioning tr.activate td {
      background: darkseagreen;
    }
    tr td {
      transition: all 1.2s;
    }
  </style>

  


    <script>

    $.mockjax({
      url: "/activate",
      responseTime: 1800,
      response: function (settings) {
        var params = parseParams(settings.data);
        var ids = getIds(params);
        for (var i = 0; i < ids.length; i++) {
          var id = ids[i];
          dataStore.findContactById(id)['status'] = 'Active';
        }
        this.responseText = rowsTemplate(ids, dataStore.allContacts(), 'activate');
      }
    });

    $.mockjax({
      url: "/deactivate",
      responseTime: 1800,
      response: function (settings) {
        var params = parseParams(settings.data);
        var ids = getIds(params);
        for (var i = 0; i < ids.length; i++) {
          var id = ids[i];
          dataStore.findContactById(id)['status'] = 'Inactive';
        }
        this.responseText = rowsTemplate(ids, dataStore.allContacts(), 'deactivate');
      }
    });

    function getIds(params) {
      if(params['ids']) {
        if($.isArray(params['ids'])) {
          return $.map(params['ids'], function(val) {
            return parseInt(val);
          })
        } else {
          return [parseInt(params['ids'])];
        }
      } else {
        return [];
      }
    }

    //========================================================================
    // Mock Server-Side Templates
    //========================================================================
    function rowsTemplate(ids, contacts, action) {
      var txt = "";
      for (var i = 0; i < contacts.length; i++) {
        var c = contacts[i];
        console.log($.inArray(i, ids));
        txt += "<tr" + ($.inArray(i, ids) >= 0 ? " class='" + action + "'" : "") +  "> \
                  <td><input type='checkbox' name='ids' value='" + i + "'></td><td>" + c.name + "</td><td>" + c.email + "</td><td>" + c.status + "</td> \
                </tr>";
      }
      return txt;
    }

    //========================================================================
    // Mock Data Store
    //========================================================================
    var dataStore = function(){
      var data = [
        { name: "Joe Smith", email: "joe@smith.org", status: "Active" },
        { name: "Angie MacDowell", email: "angie@macdowell.org", status: "Active" },
        { name: "Fuqua Tarkenton", email: "fuqua@tarkenton.org", status: "Active" },
        { name: "Kim Yee", email: "kim@yee.org", status: "Inactive" }
      ];
      return {
        findContactById : function(id) {
          return data[id];
        },
        allContacts : function() {
          return data;
        }
      }
    }()


  </script>
  
</body>
</html>