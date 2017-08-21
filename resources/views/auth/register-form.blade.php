<style>
    .custom-combobox {
        position: relative;
        display: inline-block;
    }
    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }
    .custom-combobox-input {
        margin: 0;
        padding-top: 2px;
        padding-bottom: 5px;
        padding-right: 5px;
    }
</style>

<form method="POST"
      action="{{ url('/register') }}">

      {{ csrf_field() }}

    <!-- name input -->

    <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">

        <input id="name"
               name="name"
               type="text"
               class="form-control"
               value="{{ old('name') }}"
               placeholder="Full Name"
               required autofocus>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>

        @if ($errors->has('name'))

            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>

        @endif

    </div>

    <!-- end name input -->

    <!-- email input -->

    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">

        <input id="email"
               type="email"
               name="email"
               class="form-control"
               value="{{ old('email') }}"
               placeholder="email"
               required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>


        @if ($errors->has('email'))

            <span class="help-block">
                 <strong>{{ $errors->first('email') }}</strong>
            </span>

        @endif

    </div>

    <!-- end email input -->

      {{--employmed at --}}
          <div class="form-group has-feedback{{ $errors->has('employedAt') ? ' has-error' : '' }}">

              <select id="employedAt"
                     type="employedAt"
                     name="employedAt"
                     class="form-control"
                     value="{{ old('employedAt') }}"
                     placeholder="employed at"
                      required autofocus>
                  <option disabled selected> Employed at </option>
                  <option style="color:black"> Ministry </option>
                  <option style="color:black"> District Secretary</option>
              </select>



              @if ($errors->has('employedAt'))

                  <span class="help-block">
                 <strong>{{ $errors->first('employedAt') }}</strong>
            </span>

              @endif

          </div>
      {{--employment type end--}}

      <!-- ministry input -->

          <div hidden id="ministryInput" class="form-group has-feedback{{ $errors->has('ministry') ? ' has-error' : '' }}">

                  <select id="ministry" type="ministry"
                          name="ministry"
                          class="form-control"
                          value="{{ old('ministry') }}"
                          placeholder="ministry"
                          required autofocus>
                      <option></option>
                      <option value="Ultrasound Knee Right">Ultrasound Knee Right</option>
                      <option value="Ultrasound Knee Left">Ultrasound Knee Left</option>
                      <option value="Ultrasound Forearm/Elbow Right">Ultrasound Forearm/  Elbow Right</option>
                      <option value="Ultrasound Forearm/Elbow Left">Ultrasound Forearm/Elbow Left</option>
                      <option value="MRI Knee Right">MRI Knee Right</option>
                      <option value="MRI Knee Left">MRI Knee Left</option>
                      <option value="MRI Forearm/Elbow Right">MRI Forearm/Elbow Right</option>
                      <option value="MRI Forearm/Elbow Left">MRI Forearm/Elbow Left</option>
                      <option value="CT Knee Right">CT Knee Right</option>
                      <option value="CT Knee Left">CT Knee Left</option>
                      <option value="CT Forearm/Elbow Right">CT Forearm/Elbow Right</option>
                      <option value="CT Forearm/Elbow Left">CT Forearm/Elbow Left</option>
                  </select>
              </div>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>


              @if ($errors->has('ministry'))

                  <span class="help-block">
                 <strong>{{ $errors->first('ministry') }}</strong>
            </span>

              @endif

          </div>

          <!-- end ministry input -->
          
    <!-- password input -->

    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">

        <input id="password"
               type="password"
               name="password"
               class="form-control"
               placeholder="Password"
               required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))

            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>

        @endif

    </div>

    <!-- end password input -->

    <!-- password confirmation -->

    <div class="form-group has-feedback">

        <input id="password-confirm"
               name="password_confirmation"
               type="password"
               class="form-control"
               placeholder="Retype password"
               required>

        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

    </div>

    <!-- end password confirmation -->

    <!-- row needed for separation of social links -->

    <div class="row">

        <!-- terms checkbox -->

        <div class="col-xs-8">

            <div class="checkbox">

                <label class="{{ $errors->has('terms') ? ' has-error' : '' }}">

                    <input type="checkbox" name="terms" required>

                           I agree to the <a href="/terms">terms</a>

                </label>

                @if ($errors->has('terms'))

                    <span class="help-block">
                        <strong>{{ $errors->first('terms') }}</strong>
                    </span>

                @endif

            </div>

        </div>

        <!-- end terms checkbox -->

        <!-- is_subscribed checkbox -->

        <div class="col-xs-8">

            <div class="checkbox">

                <label>

                    <input type="checkbox"
                           name="is_subscribed">

                    Subscribe to Newsletter?

                </label>

            </div>

        </div>

        <!-- end is_subscribed checkbox -->

        <!-- submit button -->
        <div class="col-xs-4">

            <button type="submit"
                    class="btn btn-primary btn-block btn-flat">

                Register

            </button>

        </div>

        <!-- end submit button -->

    </div>

</form>
<script>
    $('#employedAt').css('color','lightgrey');
    $('#employedAt').
        change(function () {
            if(this.value!="Employed at"){

                $('#employedAt').css('color','black');
            }
            if(this.value!="Ministry"){
                $('#ministryInput').hide();
            }
            else{
                $('#ministryInput').show();
            }
        });

    $( function() {
        $.widget( "custom.combobox", {
            _create: function() {
                this.wrapper = $( "<span>" )
                    .addClass( "custom-combobox" )
                    .insertAfter( this.element );

                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children( ":selected" ),
                    value = selected.val() ? selected.text() : "";

                this.input = $( "<input>" )
                    .appendTo( this.wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy( this, "_source" )
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on( this.input, {
                    autocompleteselect: function( event, ui ) {
                        ui.item.option.selected = true;
                        this._trigger( "select", event, {
                            item: ui.item.option
                        });
                    },

                    autocompletechange: "_removeIfInvalid"
                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false

                $( "<a>" )
                    .attr( "tabIndex", -1 )
                    .attr( "title", "Show All Items" )
                    .attr( "height", "" )
                    .tooltip()
                    .appendTo( this.wrapper )
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: "false"
                    })
                    .removeClass( "ui-corner-all" )
                    .addClass( "custom-combobox-toggle ui-corner-right" )
                    .on( "mousedown", function() {
                        wasOpen = input.autocomplete( "widget" ).is( ":visible" );
                    })
                    .on( "click", function() {
                        input.trigger( "focus" );

                        // Close if already visible
                        if ( wasOpen ) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete( "search", "" );
                    });
            },

            _source: function( request, response ) {
                var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                response( this.element.children( "option" ).map(function() {
                    var text = $( this ).text();
                    if ( this.value && ( !request.term || matcher.test(text) ) )
                        return {
                            label: text,
                            value: text,
                            option: this
                        };
                }) );
            },

            _removeIfInvalid: function( event, ui ) {

                // Selected an item, nothing to do
                if ( ui.item ) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children( "option" ).each(function() {
                    if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if ( valid ) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val( "" )
                    .attr( "title", value + " didn't match any item" )
                    .tooltip( "open" );
                this.element.val( "" );
                this._delay(function() {
                    this.input.tooltip( "close" ).attr( "title", "" );
                }, 2500 );
                this.input.autocomplete( "instance" ).term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $( "#ministry" ).combobox();
        $( "#toggle" ).on( "click", function() {
            $( "#combobox" ).toggle();
        });
    } );
</script>