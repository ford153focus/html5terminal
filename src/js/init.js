(() => {
    window.CommandStorage = new CommandStorage();
    window.Communicator = new Communicator();
    window.TerminalTextarea = new TerminalTextarea();

    window.Communicator.send("true");
})();
