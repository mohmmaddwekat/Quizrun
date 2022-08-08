    <div class="apply">
        <div class="content">
            <h1>{{__('Waiting!!')}}</h1>
            <p class="boay">
                {{ __("You haven't been accepted into the group yet, please wait.") }}
            </p>
            <div class="footer">
                <a class="btn btn-outline-primary" href="{{ url()->previous() }}" type="submit"
                    class="btn">{{__('Back')}}</a>
            </div>
        </div>
    </div>
