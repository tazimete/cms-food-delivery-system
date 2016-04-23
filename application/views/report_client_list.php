
  <section id="content">
    <section class="main padder">

      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
             <h3>Reports</h3>
            </header>
            <div class="panel-body">
              <div class="row text-small">
                <div class="col-sm-4 m-b-mini">
                  <select class="input-sm inline form-control" style="width:130px">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                  </select>
                  <button class="btn btn-sm btn-white">Apply</button>                
                </div>
                <div class="col-sm-4 m-b-mini">
                </div>
                <div class="col-sm-4">
                  <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                      <button class="btn btn-sm btn-white" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th width="20"><input type="checkbox"></th>
                    <th class="th-sortable" data-toggle="class">Name
                      <span class="th-sort">
                        <i class="fa fa-sort-down text"></i>
                        <i class="fa fa-sort-up text-active"></i>
                        <i class="fa fa-sort"></i>
                      </span>
                    </th>
                    <th>Location</th>
                    <th>Contact Number</th>
                    <th>Client Type</th>
                    <th width="30">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="2"></td>
                    <td>Idrawfast</td>
                    <td>4c</td>
                    <td>Jul 25, 2013</td>
                    <td>Restaurant</td>
                    <td>
                      <a href="#" class="active" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="3"></td>
                    <td>Formasa</td>
                    <td>8c</td>
                    <td>Jul 22, 2013</td>
					<td>Restaurant</td>
                    <td>
                      <a href="#" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="4"></td>
                    <td>Avatar system</td>
                    <td>15c</td>
                    <td>Jul 15, 2013</td>
					<td>Company</td>
                    <td>
                      <a href="#" class="active" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="4"></td>
                    <td>Throwdown</td>
                    <td>4c</td>
                    <td>Jul 11, 2013</td>
					<td>Restaurant</td>
                    <td>
                      <a href="#" class="active" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="5"></td>
                    <td>Idrawfast</td>
                    <td>4c</td>
                    <td>Jul 7, 2013</td>
					<td>Company</td>
                    <td>
                      <a href="#" class="active" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="6"></td>
                    <td>Formasa</td>
                    <td>8c</td>
                    <td>Jul 3, 2013</td>
					<td>Restaurant</td>
                    <td>
                      <a href="#" class="active" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="7"></td>
                    <td>Avatar system </b></td>
                    <td>15c</td>
                    <td>Jul 2, 2013</td>
					<td>Restaurant</td>
                    <td>
                      <a href="#" class="active" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="post[]" value="8"></td>
                    <td>Videodown</td>
                    <td>4c</td>
                    <td>Jul 1, 2013</td>
					<td>Company</td>
                    <td>
                      <a href="#" class="active" data-toggle="class"><i class="fa fa-check fa-lg text-success text-active"></i><i class="fa fa-times fa-lg text-danger text"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <footer class="panel-footer">
              <div class="row">
                <div class="col-sm-4 hidden-xs">
                  <select class="input-sm inline form-control" style="width:130px">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                  </select>
                  <button class="btn btn-sm btn-white">Apply</button>                  
                </div>
                <div class="col-sm-3 text-center">
                  <small class="text-muted inline m-t-small m-b-small">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-5 text-right text-center-sm">                
                  <ul class="pagination pagination-small m-t-none m-b-none">
                    <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                  </ul>
                </div>
              </div>
            </footer>
          </section>
        </div>
      </div>
    </section>
  </section>
 