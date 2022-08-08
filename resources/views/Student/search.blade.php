<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">{{ __('Search') }}</h2>
            <form action="{{ route('student.search.query') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Sort') }}:</label>
                                    <select class="selectpicker @error('sort') is-invalid @enderror" name="sort"
                                        style="width: 100%;">
                                        @if (old('sort'))
                                            @if (old('sort') == 'ASC')
                                                <option selected>ASC</option>
                                                <option>DESC</option>
                                            @elseif(old('sort') == 'DESC')
                                                <option>ASC</option>
                                                <option selected>DESC</option>
                                            @endif
                                        @else
                                            <option selected>ASC</option>
                                            <option>DESC</option>
                                        @endif
                                    </select>
                                    @error('sort')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('Order By') }}:</label>
                                    <select class="selectpicker @error('order') is-invalid @enderror" name="order"
                                        style="width: 100%;">
                                        @if (old('order'))
                                            @if (old('order') == 'name')
                                                <option selected>{{ __('name') }}</option>
                                                <option>{{ __('Description') }}</option>
                                            @elseif(old('order') == 'description')
                                                <option>{{ __('name') }}</option>
                                                <option selected>{{ __('Description') }}</option>
                                            @endif
                                        @else
                                            <option selected>{{ __('name') }}</option>
                                            <option>{{ __('Description') }}</option>
                                        @endif

                                    </select>
                                    @error('order')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-validation">

                            <div class="input-group input-group-lg">
                                <input type="search" name="message"
                                    class="form-control @error('message') is-invalid @enderror form-control-lg"
                                    value="{{ old('message') }}" placeholder="{{__('Enter keywords here')}}">
                                @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default send">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="invalid-feedback error" style="display: none">
                                {{ __('Please enter a message') }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="list-group">
                        @forelse ($groups as $group)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        @php
                                            $path = $group->image == null ? '/assets/img/image-placeholder.png' : '/assets/uploads/' . $group->image;
                                        @endphp
                                        <img src="{{ $path }}" class="img-fluid" alt="{{__('Photo')}}"
                                            style="max-height: 160px;">
                                    </div>
                                    <div class="col px-4">
                                        <div>
                                            <div class="float-right">created at: {{ $group->created_at }}</div>
                                            <h3>{{ $group->name }}</h3>
                                            <p class="mb-0">{{ $group->description }}</p>
                                            @php
                                                $group_user = $group
                                                    ->users()
                                                    ->pluck('id')
                                                    ->toArray();
                                            @endphp
                                            @if (!in_array(auth('student')->id(), $group_user))
                                                <button class="btn btn-outline-primary join"
                                                    onclick="joinGroup({{ $group->id }})">{{__('Join')}}</button>
                                            @else
                                                <a href="{{ route('student.group.index', $group->id) }}"
                                                    class="btn btn-outline-primary">{{__('Go')}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h4 class="text-center">{{ __('There is no data to display') }}</h4>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function joinGroup(id) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "group/join/" + id,
            type: "POST",
            groupType: "json",
            success: function(result) {
                console.log(result);
                if (result) {
                    $('.join').css("display", "none")
                    Toast.fire({
                        icon: "{{__('Success')}}",
                        title: "{{__('The request to join has been successfully sent.')}}"
                    })
                } else {
                    Toast.fire({
                        icon: "{{__('Error')}}",
                        title: "{{__('The request was not sent, a problem occurred.')}}"
                    })
                }
            },
        });
    }
</script>
