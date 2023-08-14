Public Class frmMain

    ' Variables
    Private BXLAPI As New clsBXLAPI

    Private callbackFunc As clsBXLAPI.BXLCallBackDelegate = Nothing

    Public Const PRN_STATUS_NORMAL = 0
    Public Const PRN_STATUS_OFFLINE = 1
    Public Const PRN_STATUS_PAPER_OUT = 2
    Public Const PRN_STATUS_NEAR_END_ERR = 4
    Public Const PRN_STATUS_DOOR_OPEN = 8
    Public Const PRN_STATUS_CASHDRAWER_OPEN = 16
    Public Const PRN_STATUS_AUTOCUTTER_ERR = 32
    Public Const PRN_STATUS_MECHANICAL_ERR = 64
    Public Const PRN_STATUS_UN_RECOVERABLE_ERR = 128
    Public Const PRN_STATUS_BATTERY_LOW = 512


    Private Sub frmMain_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load

    End Sub


    Private Sub EnableCtrls(ByVal bConnect As Boolean)
        txtPrinterName.Enabled = Not bConnect
        btnConnect.Enabled = Not bConnect
        btnDisconnect.Enabled = bConnect
        btnPrint_Receipt.Enabled = bConnect
        btnStatus_Get.Enabled = bConnect
        btnStatus_Set.Enabled = bConnect
        btnStatus_Cancel.Enabled = False

    End Sub

    Private Sub btnConnectClick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnConnect.Click
        If (BXLAPI.ConnectPrinter(txtPrinterName.Text.Trim())) Then
            EnableCtrls(True)
        End If
    End Sub

    Private Sub btnDisconnectClick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnDisconnect.Click
        BXLAPI.DisconnectPrinter()
        BXLAPI.BidiCloseMonPrinter()
        EnableCtrls(False)
        callbackFunc = Nothing

    End Sub

    Private Sub btnPrintReceiptClick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPrint_Receipt.Click
        Dim nPositionX As Integer = 0
        Dim nPositionY As Integer = 0
        Dim nTextHeight As Integer = 0

        ' Start Document
        If (BXLAPI.Start_Doc("Print Receipt") = False) Then
            Exit Sub
        End If

        ' Start Page
        BXLAPI.Start_Page()
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "x")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA2x2", 17, "* BIXOLON CAFE *")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Bundang-gu, Seongam-si")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Sampyeong-dong, 685")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Tel) 858-519-3698 Fax) 3852")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "w")
        nPositionY += nTextHeight * 2
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "------------------------------------------")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "ORANGE                              $3,500")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "BUFALO WING                         $3,000")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "POTATO                              $1,200")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "------------------------------------------")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Total                               $7,700")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Tax 6%                                $470")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Member Discount                       $900")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Money received                     $10,000")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "Change                              $2,730")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontA1x1", 8, "------------------------------------------")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "x")
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "Code128", 18, "123456789012")
        nPositionX = 80
        nPositionY += nTextHeight / 2
        nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "Member Number : 452331949", False, 0, True, False)
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "HAVE A NICE DAY!", False, 0, True, False)
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "Sale Date: 07/01/03", False, 0, True, False)
        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintTrueFont(nPositionX, nPositionY, "Arial", 10, "Time: 12:30:45", False, 0, True, False)
        nPositionX = 150
        nPositionY += nTextHeight * 2
        nTextHeight = BXLAPI.PrintBitmap(nPositionX, nPositionY, ".\\free.bmp")
        BXLAPI.End_Page()   ' End Page
        BXLAPI.End_Doc()    ' End Document
    End Sub

    Private Sub btnExit_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnExit.Click
        Me.Close()
    End Sub

    Private Sub frmMain_FormClosed(ByVal sender As System.Object, ByVal e As System.Windows.Forms.FormClosedEventArgs) Handles MyBase.FormClosed
        BXLAPI.DisconnectPrinter()
        BXLAPI.BidiCloseMonPrinter()
        callbackFunc = Nothing
        BXLAPI = Nothing
    End Sub


    Public Function interpretPrinterStatusData(ByVal nStatus As Integer) As Integer
        If (nStatus = PRN_STATUS_NORMAL) Then
            MessageBox.Show("PRN_STATUS_NORMAL", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
            Return PRN_STATUS_NORMAL
        End If

        ' First
        If nStatus And PRN_STATUS_OFFLINE Then
            MessageBox.Show("PRN_STATUS_OFFLINE", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
            Return PRN_STATUS_OFFLINE
        End If

        If nStatus And PRN_STATUS_DOOR_OPEN Then
            MessageBox.Show("PRN_STATUS_DOOR_OPEN", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        End If

        If nStatus And PRN_STATUS_CASHDRAWER_OPEN Then
            MessageBox.Show("PRN_STATUS_CASHDRAWER_OPEN", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        End If

        ' Second
        If nStatus And PRN_STATUS_BATTERY_LOW Then
            MessageBox.Show("PRN_STATUS_BATTERY_LOW", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        ElseIf nStatus And PRN_STATUS_MECHANICAL_ERR Then
            MessageBox.Show("PRN_STATUS_MECHANICAL_ERR", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        ElseIf nStatus And PRN_STATUS_AUTOCUTTER_ERR Then
            MessageBox.Show("PRN_STATUS_AUTOCUTTER_ERR", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        ElseIf nStatus And PRN_STATUS_UN_RECOVERABLE_ERR Then
            MessageBox.Show("PRN_STATUS_UN_RECOVERABLE_ERR", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        End If

        ' Third
        If nStatus And PRN_STATUS_NEAR_END_ERR Then
            MessageBox.Show("PRN_STATUS_NEAR_END_ERR", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        ElseIf nStatus And PRN_STATUS_PAPER_OUT Then
            MessageBox.Show("PRN_STATUS_PAPER_OUT", "BIXOLON", MessageBoxButtons.OK, MessageBoxIcon.Information)
        End If

        Return nStatus

    End Function

    Public Function statusCallBackMethod(ByVal nStatus As Integer) As Integer
        Return interpretPrinterStatusData(nStatus)
    End Function

    Private Sub btnGetStatusClick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnStatus_Get.Click
        If (BXLAPI.BidiOpenMonPrinter(txtPrinterName.Text.Trim())) Then
            interpretPrinterStatusData(BXLAPI.BidiGetStatus())
            BXLAPI.BidiCloseMonPrinter()
        Else
            MsgBox("BidiOpenMonPrinter failed")
        End If
    End Sub

    Private Sub btnRegisterCallbackFunction(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnStatus_Set.Click
        If (BXLAPI.BidiOpenMonPrinter(txtPrinterName.Text.Trim())) Then
            callbackFunc = AddressOf statusCallBackMethod
            'BXLAPI.BidiSetStatusBackFunction(callbackFunc)
            BXLAPI.BidiSetCallBackFunction(callbackFunc, Nothing)
            btnStatus_Get.Enabled = False
            btnStatus_Set.Enabled = False
            btnStatus_Cancel.Enabled = True
        Else
            MsgBox("BidiOpenMonPrinter failed")
        End If
    End Sub

    Private Sub btnUnRegisterCallbackFunction(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnStatus_Cancel.Click
        BXLAPI.BidiCancelCallBackFunction()
        callbackFunc = Nothing
        btnStatus_Get.Enabled = True
        btnStatus_Set.Enabled = True
        btnStatus_Cancel.Enabled = False
    End Sub
End Class
