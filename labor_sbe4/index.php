<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once "D:/xampp/htdocs/wbd/backend/api/index.php";
require_once "D:/xampp/htdocs/wbd/backend/data_process/index.php";
require_once "D:/xampp/htdocs/wbd/backend/middleware/index.php";

cors();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $wo 			    = addslashes($data["wo"]);
    $desc 				= addslashes($data["desc"]);
    $dept 				= addslashes($data["dept"]);
    $wkctr 				= addslashes($data["wkctr"]);
    $run_crew           = addslashes($data["run_crew"]);
    $id 				= addslashes($data["id"]);
    $id                 = str_replace(" ", "", $id);
    $operation 			= addslashes($data["operation"]);
    $document 			= addslashes($data["document"]);
    $employee 			= addslashes($data["employee"]);
    $qty_completed 	    = addslashes($data["qty_completed"]);
    $effective_date     = addslashes($data["effective_date"]);
    $stop_setup 		= addslashes($data["stop_setup"]);
    $stop_run 			= addslashes($data["stop_run"]);
    $comment1 			= addslashes($data["comment"]);
    $comment1 			= preg_replace('!\s+!', ' ', $comment1);
    $comment 			= addslashes($comment1 ." (QX-".$username_log.")");
    $comment 			= preg_replace('!\s+!', ' ', $comment);
    $down_time 			= addslashes($data["down_time"]);
    $dt_reason 			= addslashes($data["dt_reason"]);
    $pp                 = addslashes($data["pp"]);
    $start_down_time    = addslashes($data["start_down_time"]);
    $end_down_time      = addslashes($data["end_down_time"]);
    $problem_desc       = addslashes($data["problem_desc"]);
    $fixed_asset        = addslashes($data["fixed_asset"]);
    $expFixAsset        = explode("|-|", $fixed_asset);
    $assetno            = $expFixAsset[0];
    $assetname          = $expFixAsset[1];
    $wocomp 	        = "false";
    $move 		        = "false";
    $compprev           = "false";
    $rejects 	        = "false";
    $reworks 	        = "false";
    $err_nm 	        = "";

    if (!isset($_POST['stop_setup'])) {
        $stop_setup = 0;
    }

    if (!isset($_POST['stop_run'])) {
        $stop_run = 0;
    }

    if (!isset($_POST['down_time'])) {
        $down_time = 0;
    }

    if (isset($_POST['wocomp'])) {
        $wocomp = "true";
    }

    if (isset($_POST['move'])) {
        $move = "true";
    }

    if (isset($_POST['compprev'])) {
        $compprev = "true";
    }

    if (isset($_POST['rejects'])) {
        $rejects = "true";
        $arrRejectCode 	= $_POST['reject_code'];
        $arrQtyReject 	= $_POST['qty_reject'];
    }

    if (isset($_POST['reworks'])) {
        $reworks = "true";
        $arrReworkCode 	= $_POST['rework_code'];
        $arrQtyRework 	= $_POST['qty_rework'];
    }

    function httpHeader($req)
    {
        return array(
        'Content-type: text/xml;charset="utf-8"',
        'Accept: text/xml',
        'Cache-Control: no-cache',
        'Pragma: no-cache',
        'SOAPAction: ""',        // jika tidak pakai SOAPAction, isinya harus ada tanda petik 2 --> ""
        'Content-length: ' . strlen(preg_replace("/\s+/", " ", $req))
        );
    }

    // Var Qxtend
    $qxUrl          = "http://qadsbe.site:24087/qxi/services/QdocWebService"; // Edit Here

    $timeout        = 0;

    // XML QXtend ** Edit Here
    $qdocHead = '<?xml version="1.0" encoding="UTF-8"?>
                <soapenv:Envelope xmlns="urn:schemas-qad-com:xml-services"
                xmlns:qcom="urn:schemas-qad-com:xml-services:common"
                xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsa="http://www.w3.org/2005/08/addressing">
                <soapenv:Header/>
                <soapenv:Body>
                    <recordLaborFeedbackbyWO>
                    <qcom:dsSessionContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>To</qcom:propertyName>
                        <qcom:propertyValue>urn:services-qad-com:QADERP</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>MessageID</qcom:propertyName>
                        <qcom:propertyValue>urn:services-qad-com::QADERP</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>suppressResponseDetail</qcom:propertyName>
                        <qcom:propertyValue>true</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>ReplyTo</qcom:propertyName>
                        <qcom:propertyValue>urn:services-qad-com:</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>domain</qcom:propertyName>
                        <qcom:propertyValue/>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>scopeTransaction</qcom:propertyName>
                        <qcom:propertyValue>false</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>version</qcom:propertyName>
                        <qcom:propertyValue>eB_4</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>mnemonicsRaw</qcom:propertyName>
                        <qcom:propertyValue>false</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>username</qcom:propertyName>
                        <qcom:propertyValue>mfg</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>password</qcom:propertyName>
                        <qcom:propertyValue>qadSBE123!@#</qcom:propertyValue>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>entity</qcom:propertyName>
                        <qcom:propertyValue/>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>email</qcom:propertyName>
                        <qcom:propertyValue/>
                        </qcom:ttContext>
                        <qcom:ttContext>
                        <qcom:propertyQualifier>QAD</qcom:propertyQualifier>
                        <qcom:propertyName>emailLevel</qcom:propertyName>
                        <qcom:propertyValue/>
                        </qcom:ttContext>
                    </qcom:dsSessionContext>';

    $qdocbody = '			<dsWOLaborFeedback>
                                    <WOLaborFeedback>
                                        <operation>A</operation>
                                        <wrLot>'.$id.'</wrLot>
                                        <wrOp>'.$operation.'</wrOp>
                                        <opDoc>'.$document.'</opDoc>
                                        <emp>'.$employee.'</emp>
                                            <yn>true</yn>
                                        <opQtyComp>'.$qty_completed.'</opQtyComp>
                                        <rejects>'.$rejects.'</rejects>
                                        <reworks>'.$reworks.'</reworks>
                                        <effDate>'.$effective_date.'</effDate>
                                            <wocomp>'.$wocomp.'</wocomp>
                                            <move>'.$move.'</move>
                                            <compprev>'.$compprev.'</compprev>
                                        <stopSetup>'.$stop_setup.'</stopSetup>
                                        <stopRun>'.$stop_run.'</stopRun>
                                        <opComment>'.$comment.'</opComment>
                                        <downtime>'.$down_time.'</downtime>
                                        <reason>'.$dt_reason.'</reason>
                                        <yn1>true</yn1>
                                        <yn2>true</yn2>
                                        <yn3>true</yn3>';

    if ($rejects == "true") {
        for ($i=0; $i < count($arrRejectCode); $i++) {
            $reject_code 	= $arrRejectCode[$i];
            $qty_reject 	= $arrQtyReject[$i];

            $qdocbody .= '		<rejectsDetail>
                                        <operation>A</operation>
                                        <rejreason>'.$reject_code.'</rejreason>
                                        <rejqty>'.$qty_reject.'</rejqty>
                                        </rejectsDetail>';
        }
    }

    if ($reworks == "true") {
        for ($i=0; $i < count($arrReworkCode); $i++) {
            $rework_code 	= $arrReworkCode[$i];
            $qty_rework 	= $arrQtyRework[$i];

            $qdocbody .= '		<reworksDetail>
                                        <operation>A</operation>
                                        <rwkreason>'.$rework_code.'</rwkreason>
                                        <rwkqty>'.$qty_rework.'</rwkqty>
                                        </reworksDetail>';
        }
    }

    $qdocbody .= '   		</WOLaborFeedback>
                                        </dsWOLaborFeedback>';

    $qdocfoot = '		</recordLaborFeedbackbyWO>
                                </soapenv:Body>
                            </soapenv:Envelope>';

    $qdocRequest = $qdocHead . $qdocbody . $qdocfoot;

    /*
    $curlOptions = array(
    CURLOPT_URL => $qxUrl,
    CURLOPT_CONNECTTIMEOUT => $timeout,        // in seconds, 0 = unlimited / wait indefinitely.
    CURLOPT_TIMEOUT => $timeout + 120, // The maximum number of seconds to allow cURL functions to execute. must be greater than CURLOPT_CONNECTTIMEOUT
    CURLOPT_HTTPHEADER => httpHeader($qdocRequest),
    CURLOPT_POSTFIELDS => preg_replace("/\s+/", " ", $qdocRequest),
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
    );

    $getInfo = '';
    $httpCode = 0;
    $curlErrno = 0;
    $curlError = '';


    $qdocResponse = '';

    $curl = curl_init();
    if ($curl) {
        curl_setopt_array($curl, $curlOptions);
        $qdocResponse = curl_exec($curl);           // sending qdocRequest here, the result is qdocResponse.
        //
        $curlErrno = curl_errno($curl);
        $curlError = curl_error($curl);
        $first = true;
        foreach (curl_getinfo($curl) as $key => $value) {
        if (gettype($value) != 'array') {
            if (!$first) $getInfo .= ", ";
            $getInfo = $getInfo . $key . '=>' . $value;
            $first = false;
            if ($key == 'http_code') $httpCode = $value;
        }
        }
        curl_close($curl);
    }
*/
}

?>