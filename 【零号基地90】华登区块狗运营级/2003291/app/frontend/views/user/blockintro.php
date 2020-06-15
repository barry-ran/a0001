<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Yii::t('app','区块源码')?></title>
    <link rel="stylesheet" href="/css/ymj.css" />
    <link rel="stylesheet" href="/css/resetTable.css" />
    <link rel="stylesheet" href="/css/page2.css" />
    <style>
        body{
            overflow: auto;
        }
        *, :after, :before{
            box-sizing: content-box;
        }
        .userGo{
            width: 90%;
            margin-left: 5%;
        }
    </style>
</head>
<body>

<!--主背景块-->
<div class="userGo">
    <p>
        pragma solidity ^0.4.16;
    </p>
    <p>
        <br/>
    </p>
    <p>
        interface tokenRecipient {
    </p>
    <p>
        &nbsp; &nbsp; function receiveApproval(address _from, uint256 _value, address _token, bytes _extraData) external;
    </p>
    <p>
        }
    </p>
    <p>
        <br/>
    </p>
    <p>
        contract TokenERC20 {
    </p>
    <p>
        &nbsp; &nbsp; // Public variables of the token string public name; string public symbol; uint8 public decimals = 18;
    </p>
    <p>
        &nbsp; &nbsp; // 18 decimals is the strongly suggested default, avoid changing it uint256 public totalSupply;
    </p>
    <p>
        &nbsp; &nbsp; // This creates an array with all balances mapping (address =&gt; uint256) public balanceOf; mapping (address =&gt; mapping (address =&gt; uint256)) public allowance;
    </p>
    <p>
        &nbsp; &nbsp; // This generates a public event on the blockchain that will notify clients event Transfer(address indexed from, address indexed to, uint256 value);
    </p>
    <p>
        &nbsp; &nbsp; // This notifies clients about the amount burnt event Burn(address indexed from, uint256 value);
    </p>
    <p>
        }
    </p>
    <p>
        <br/>
    </p>
    <p>
        /**
    </p>
    <p>
        * Constructor function * * Initializes contract with initial supply tokens to the creator of the contract
    </p>
    <p>
        */
    </p>
    <p>
        function TokenERC20( uint256 initialSupply, string tokenName, string tokenSymbol ) public {
    </p>
    <p>
        &nbsp; &nbsp; totalSupply = initialSupply * 10 ** uint256(decimals);
    </p>
    <p>
        &nbsp; &nbsp; // Update total supply with the decimal amount balanceOf[msg.sender] = totalSupply;
    </p>
    <p>
        &nbsp; &nbsp; // Give the creator all initial tokens name = tokenName; // Set the name for display purposes symbol = tokenSymbol;
    </p>
    <p>
        &nbsp; &nbsp; // Set the symbol for display purposes
    </p>
    <p>
        }
    </p>
    <p>
        <br/>
    </p>
    <p>
        /**
    </p>
    <p>
        * Internal transfer, only can be called by this contract
    </p>
    <p>
        */
    </p>
    <p>
        function _transfer(address _from, address _to, uint _value) internal {
    </p>
    <p>
        &nbsp; &nbsp; // Prevent transfer to 0x0 address. Use burn() instead require(_to != 0x0);
    </p>
    <p>
        &nbsp; &nbsp; // Check if the sender has enough require(balanceOf[_from] &gt;= _value);
    </p>
    <p>
        &nbsp; &nbsp; // Check for overflows require(balanceOf[_to] + _value &gt;= balanceOf[_to]);
    </p>
    <p>
        &nbsp; &nbsp; // Save this for an assertion in the future uint previousBalances = balanceOf[_from] + balanceOf[_to];
    </p>
    <p>
        &nbsp; &nbsp; // Subtract from the sender balanceOf[_from] -= _value;
    </p>
    <p>
        &nbsp; &nbsp; // Add the same to the recipient balanceOf[_to] += _value; emit Transfer(_from, _to, _value);
    </p>
    <p>
        &nbsp; &nbsp; // Asserts are used to use static analysis to find bugs in your code. They should never fail assert(balanceOf[_from] + balanceOf[_to] == previousBalances);
    </p>
    <p>
        }
    </p>
    <p>
        <br/>
    </p>
</div>

<!--<script type="text/javascript" src="/js/canvas-particle.js"></script>-->
<script charset="utf-8" src="/js/3.2.1.js"></script>
</body>
</html>



