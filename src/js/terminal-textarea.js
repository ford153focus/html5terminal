class TerminalTextarea
{
    initWarnings () {
        this.target.value += "Don't use `su`, `nano` and other commands that using interactive mode\n";
        this.target.value += "Don't use `sudo` without '-S' and be sure that current user in sudoers list\n";
    }

    printAjaxResponse (response) {
        this.preCommand = response.substr(0, response.indexOf("$"));
        this.target.value += response;
        this.target.scrollTop = this.target.scrollHeight; //scroll textarea down
        this.focusAtEnd();
    }

    /**
     * place cursor at end of textarea
     * maybe browser can it without that workaround now?
     */
    focusAtEnd () {
        setTimeout(function () {
            const data = this.target.value;
            this.target.focus();
            this.target.value = "";
            this.target.value = data;
        }.bind(this), 15)
    }

    /**
     * Parse current content of textarea and get last entered command
     * @returns {boolean||string}
     */
    getCurrentCommand () {
        const textarea_value = this.target.value.trim();

        if (textarea_value === "" || textarea_value[textarea_value.length] === "$") {
            console.log("Attempt to send empty string");
            return false;
        }

        const preCommandPosition = this.target.value.lastIndexOf("$");

        if (preCommandPosition === -1) {
            console.log("Damaged textarea content");
            return false;
        }

        return textarea_value
            .substr(preCommandPosition + 1, textarea_value.length - preCommandPosition)
            .trim()
    }

    /**
     * Keyboard events
     * navigation and send
     */
    keyBinder () {
        window.onkeyup = function (event) {
            switch (event.keyCode) {
                case 38:
                    window.CommandStorage.commandHistoryNavigation("up");
                    this.focusAtEnd();
                    break;
                case 40:
                    window.CommandStorage.commandHistoryNavigation("down");
                    this.focusAtEnd();
                    break;
                case 13:
                    window.Communicator.send(this.getCurrentCommand());
                    break;
                case 8:
                    let preCommandPosition = this.target.value.lastIndexOf("$");
                    let cursorPos = this.target.selectionStart;
                    console.log(preCommandPosition, cursorPos)

                    if (cursorPos < preCommandPosition) event.preventDefault();

                    let value = this.target.value.substr(0, cursorPos-1);
                    value += this.target.value.substr(cursorPos, this.target.value.length-1);
                    this.target.value = value;

                    break;
            }
        }.bind(this);
    }
    
    constructor() {
        this.target = document.getElementById("ta1");
        this.initWarnings();
        this.keyBinder();
    }
}
