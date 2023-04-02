<div class="row">
    <form method="GET" action="{{route('data.index')}}" accept-charset="UTF-8" class="">
        <div class="btn-group btn-group-toggle nav-search__btn-grp m-0 p-0 col-md-4" data-toggle="buttons">
            <label class="btn btn-secondary active">
              <input type="radio" name="category" id="option1" autocomplete="off"  {{ isset($search_type) &&  $search_type == "papers"? 'checked':''}} value="papers"> Papers
            </label>
            <label class="btn btn-secondary">
              <input type="radio" name="category" id="option2" autocomplete="off" {{ isset($search_type) &&  $search_type == "news"? 'checked':''}} value="news"> News
            </label>
        </div>
        <div id="custom-search-input" class="col-md-8">
            <div class="row">
                <div class="col-md-12 m-0 p-0">
                    <input type="text" class="form-control" value="{{ request()->query('keyword') }}" placeholder="Search Paper or News" name="keyword"/>           
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-md" type="submit">
                            <i class="ficon ft-search"></i>
                        </button>
                    </span> 
                </div>
                <!-- <div class="col-md-2 m-0 p-0">              
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-md" type="submit">
                            <i class="ficon ft-search"></i>
                        </button>
                    </span> 
                </div> -->
            </div>                  
        </div>
    </form>
</div>