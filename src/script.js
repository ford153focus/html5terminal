/**
 * unique namespace to avoid collisions
 */
if (tk == undefined)
{
	var tk = {};
}
if (tk.reiltech == undefined)
{
	tk.reiltech = {};
}

tk.reiltech.RemoteConsole =
{
	Ajax:
	{
		/**
		 * Do synchronous ajax-request
		 * Doing it synchronous to lock input before answer received
		 * @param {string} command
		 */
		executeRequest: function (command)
		{
			var AjaxRequestObject = new XMLHttpRequest();
			AjaxRequestObject.open('POST', location.pathname, false);
			AjaxRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			AjaxRequestObject.send("query=" + command);
			return AjaxRequestObject.response;

		},
		/**
		 * Parse json that incoming in ajax
		 * @param {JSON} response - JSON-string
		 */
		parseResponse: function (response)
		{
			var parsedResponse = JSON.parse(response);
			var currentUser = parsedResponse.currentUser;
			var hostName = parsedResponse.hostName;
			var currentDirectory = parsedResponse.currentDirectory;
			var commandOutput = parsedResponse.commandOutput;
			return commandOutput + "\n" + currentUser + '@' + hostName + ':' + currentDirectory + "$ ";
		},

		/**
		 * send command to server
		 * push command to history
		 * @param {string} command
		 */
		send: function (command)
		{
			var response = this.executeRequest(command);
			var parsedResponse = this.parseResponse(response);
			this.parent.TextArea.printAjaxResponse(parsedResponse);

			this.parent.History.archive.push(command); //add command to history
			this.parent.History.pointer = this.parent.History.archive.length; //set pointer
		}
	},
	History:
	{
		archive: [], //Here we will store history of commands that was put by user
		pointer: 0, //user can navigate in history with arrows so we need store pointer that looking at current position
		/**
		 * Navigation in history
		 * @param direction
		 * @returns {boolean}
		 */
		commandHistoryNavigation: function (direction)
		{
			if (
				this.archive.length == 0 || //if history is empty - exit
				this.pointer == 0 && direction == "up" || //if pointer looking at first element in history and user requiring previous (-1, unexisting element) - exit
				this.pointer == this.archive.length -1 && direction == "down" //if pointer looking at last element in history and user requiring next (out of array's range, unexisting element) - exit
			)
			{
				return false;
			}

			/*moving pointer*/
			if (direction == "up")
			{
				this.pointer--;
			}
			if (direction == "down")
			{
				this.pointer++;
			}
			/**/

			var preCommandPosition = this.parent.TextArea.target.value.lastIndexOf("$");

			if (preCommandPosition == -1)
			{
				this.parent.TextArea.target.value = this.parent.TextArea.preCommand + this.archive[this.pointer];
			}
			else
			{
				this.parent.TextArea.target.value = this.parent.TextArea.target.value.substr(0, preCommandPosition) + "$ " + this.archive[this.pointer]
			}
		}
	},
	TextArea:
	{
		initWarnings: function() {
			this.target.value += "Don't use `su`, `nano` and other commands that using interactive mode\n";
			this.target.value += "Don't use `sudo` without '-S' and be sure that current user in sudoers list\n";
		},
		printAjaxResponse: function(response)
		{
			this.preCommand = response.substr(0, response.indexOf("$"));
			this.target.value += response;
			this.target.scrollTop = this.target.scrollHeight; //scroll textarea down
			this.focusAtEnd();
		},
		/**
		 * place cursor at end of textarea
		 * maybe browser can it without that workaround now?
		 */
		focusAtEnd: function ()
		{
			setTimeout(function ()
			{
				var data = this.target.value;
				this.target.focus();
				this.target.value = "";
				this.target.value = data;
			}.bind(this), 15)
		},
		/**
		 * Parse current content of textarea and get last entered command
		 * @returns {boolean||string}
		 */
		getCurrentCommand: function ()
		{
			var textarea_value = this.target.value.trim();

			if (textarea_value == "" || textarea_value[textarea_value.length] == "$")
			{
				console.log("Attempt to send empty string");
				return false;
			}

			var preCommandPosition = this.target.value.lastIndexOf("$");

			if (preCommandPosition == -1)
			{
				console.log("Damaged textarea content");
				return false;
			}

			return textarea_value
				.substr(preCommandPosition + 1,	textarea_value.length - preCommandPosition)
				.trim()
		},

		/**
		 * Keyboard events
		 * navigation and send
		 */
		keyBinder: function ()
		{
			window.onkeyup = function (event)
			{
				switch (event.keyCode)
				{
					case 38:
						this.parent.History.commandHistoryNavigation("up");
						this.focusAtEnd();
						break;
					case 40:
						this.parent.History.commandHistoryNavigation("down");
						this.focusAtEnd();
						break;
					case 13:
						this.parent.Ajax.send( this.getCurrentCommand() );
						break;
				}
			}.bind(this);
		}
	},
	/**
	 *  like constructor, call it after object description
	 */
	init: function ()
	{
		//JS objects doesn't contain info about parent, so...
		this.Ajax.parent = this;
		this.History.parent = this;
		this.TextArea.parent = this;

		this.TextArea.target = document.getElementById("ta1");
		this.TextArea.initWarnings();
		this.TextArea.keyBinder();

		this.Ajax.send("true");
	}
};

tk.reiltech.RemoteConsole.init();