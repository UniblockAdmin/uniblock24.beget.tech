var SimpleStorage = artifacts.require("./UCP.sol");

module.exports = function (deployer) {
    deployer.deploy(SimpleStorage);
};