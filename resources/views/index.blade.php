<x-header />

<section class="main">
    <div class="row">
        <div class="col-sm-12">
            <center>
                <h1>{{ env('APP_NAME') }}</h1>
            </center>
            <hr>
            <div class="card">
                <div class="card-header search-tag">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="token" placeholder="Enter Valid Token" />
                        </div>

                        <div class="col-md-3">
                            <button type="button" onclick="GetBlogs()" class="btn btn-primary"><i
                                    class="fa fa-search"></i>&nbsp;Fetch Blogs</button>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="card-header">

                </div>
                <div class="card-block">
                    <table class="table" id="table" style="display: none">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                        </tr>
                        <tbody id="show-record">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

</section>

<x-footer />
@include('includes.js_scripts.blogs_api_calls_js')
