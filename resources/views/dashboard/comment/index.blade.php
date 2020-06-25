@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h5 style="display: inline-block;">Comments</h5>
    <p class="pt-2">
        <a href="">All (0)</a> | <a href="">Mine (2)</a> |
        <a href="">Pending (0)</a> | <a href="">Approved (0)</a> |
        <a href="">Spam (0)</a> | <a href="">Trashed (0)</a>
    </p>
</div>

<div class="container-fluid">
    <div class="row justify-content-between pb-3">
        <div class="col-auto">
            <div class="input-group input-group-sm">
                <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                  <option selected>All comment types</option>
                  <option value="1">Comments</option>
                  <option value="2">Pings</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button">
                        <i class="fa fa-filter fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-auto">

        </div>
    </div>

    <table class="table table-sm table-bordered table-hover table-light">
        <caption>3 items</caption>
        <thead class="thead-light">
          <tr>
            <th scope="col">Autor</th>
            <th scope="col">Comment</th>
            <th scope="col">In Response To</th>
            <th scope="col">Submitted On</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <th scope="row">1</th>
          </tr>
          <tr>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            <th scope="row">2</th>
          </tr>
          <tr>
            <td>Larry the Bird</td>
            <td>Thornton</td>
            <td>@twitter</td>
            <th scope="row">3</th>
          </tr>
        </tbody>
      </table>
</div>
@endsection
