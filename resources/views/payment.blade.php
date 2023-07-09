<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Make Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
      <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Make Payment
            </div>
            <div class="card-body">
                <form action="{{route('make.order')}}" method="post">
                  @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label mb-3">Name</label>
                        <div class="col-sm-10">

                          <input type="text" name="name" class="form-control" placeholder="Enter Name"/>
                          @error('name')
                            <font color="red">{{ $message }}</font>
                          @enderror
                        </div>

                        
                        <label class="col-sm-2 col-form-label mb-3">Amount</label>
                        <div class="col-sm-10">

                          <input type="text" name="amount" class="form-control" placeholder="Enter Amount"/>
                          @error('amount')
                            <font color="red">{{ $message }}</font>
                          @enderror
                        </div>
                    </div>
                    @error('error')
                      <font color="red">{{ $message }}</font>
                    @enderror
                    <div class="form-group text-center">
                      <button type="submit" class="btn btn-primary">Make Payment</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>