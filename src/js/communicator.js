class Communicator {
    /**
     * Do synchronous ajax-request
     * Doing it synchronous to lock input before answer received
     * @param {string} command
     */
    executeRequest (command) {
        const AjaxRequestObject = new XMLHttpRequest();
        AjaxRequestObject.open('POST', location.pathname, false);
        AjaxRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        AjaxRequestObject.send("query=" + command);
        return AjaxRequestObject.response;
    }

    /**
     * Parse json that incoming in ajax
     * @param {JSON} response - JSON-string
     */
    parseResponse (response) {
        const parsedResponse = JSON.parse(response);
        const currentUser = parsedResponse.currentUser;
        const hostName = parsedResponse.hostName;
        const currentDirectory = parsedResponse.currentDirectory;
        const commandOutput = parsedResponse.commandOutput;

        return `${commandOutput}\n${currentUser}@${hostName}:${currentDirectory}$ `;
    }

    /**
     * send command to server
     * push command to history
     * @param {string} command
     */
    send (command) {
        const response = this.executeRequest(command);
        const parsedResponse = this.parseResponse(response);
        window.TerminalTextarea.printAjaxResponse(parsedResponse); //render response in text area
        window.CommandStorage.archive.push(command); //add command to history
        window.CommandStorage.pointer = window.CommandStorage.archive.length; //set pointer
    }
}
