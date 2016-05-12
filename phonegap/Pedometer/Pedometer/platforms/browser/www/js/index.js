/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');
		
		function onSuccess(acceleration) {
			/*alert('Acceleration X: ' + acceleration.x + '\n' +
				  'Acceleration Y: ' + acceleration.y + '\n' +
				  'Acceleration Z: ' + acceleration.z + '\n' +
				  'Timestamp: '      + acceleration.timestamp + '\n');*/
			var accel = 'Acceleration X: ' + acceleration.x + '\n' +
				  'Acceleration Y: ' + acceleration.y + '\n' +
				  'Acceleration Z: ' + acceleration.z + '\n' +
				  'Timestamp: '      + acceleration.timestamp + '\n';
			document.getElementById('geefterug').innerHTML = accel;
		}

		function onError() {
			alert('onError!');
		}
		
		var options = { frequency: 3000 };  // Update every 3 seconds

		var watchID = navigator.accelerometer.watchAcceleration(onSuccess, onError, options);

		navigator.accelerometer.getCurrentAcceleration(onSuccess, onError);
		
		/* navigator.camera.getPicture(onSuccess, onFail, { quality: 50,
			destinationType: Camera.DestinationType.DATA_URL
		});

		function onSuccess(imageData) {
			var image = document.getElementById('myImage');
			image.src = "data:image/jpeg;base64," + imageData;
		}

		function onFail(message) {
			alert('Failed because: ' + message);
		} */

    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
    }
};
