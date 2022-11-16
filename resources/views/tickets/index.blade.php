<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Claim Free Ticket</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card card-body">
                    <h4 class="">Claim free ticket!</h4>
                    <small class="text-muted">*Only for 5 tickets free per day</small>

                    <form method="post" action="{{ route('ticket.store') }}" class="mt-2">
                        @if($errors->all())
                            <ul class="text-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @csrf
                        <label>
                            Name
                            <input class="form-control" name="user" type="text" value="{{ old('user') }}">
                        </label><br><br>

                        <button v-if="!isAddGuest" @click="toggleGuest" type="button" class="btn btn-sm btn-info mb-2">Add Guest + </button>
                        <button v-else @click="toggleGuest" type="button" class="btn btn-sm btn-info mb-2">Remove Guest - </button><br>

                        <div v-if="isAddGuest">
                            <label>
                                Guest Name
                                <input class="form-control" name="guest" type="text" value="{{ old('guest') }}">
                            </label><br><br>
                        </div>


                        <label for="">
                            <input class="form-control" name="date" type="date" value="{{ old('date') }}">
                        </label><br><br>

                        <button class="btn btn-success" type="submit">Claim</button>
                    </form>

                </div>

                @if(session('message'))
                    <div class="card card-body mt-2">
                        <span class="text-success text-center">
                            {{ session('message') }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const { createApp } = Vue

    createApp({
        data() {
            return {
                message: 'Hello Vue!',
                isAddGuest: {{ old('guest') ? 'true' : 'false' }},
            }
        },
        methods: {
            toggleGuest() {
                this.isAddGuest = !this.isAddGuest
            }
        }
    }).mount('#app')
</script>
</body>
</html>
