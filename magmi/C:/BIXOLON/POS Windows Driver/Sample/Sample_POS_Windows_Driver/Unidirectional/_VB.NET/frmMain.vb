﻿Public Class frmMain

    ' Cash Draw Speed
    Public Const SPEED_50MS As Integer = 0
    Public Const SPEED_100MS As Integer = 1
    Public Const SPEED_150MS As Integer = 2
    Public Const SPEED_200MS As Integer = 3
    Public Const SPEED_250MS As Integer = 4

    ' Variables
    Private BXLAPI As New clsBXLAPI


    Private Sub frmMain_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        cmbDeviceFont.Items.Clear()

        'Font A
        cmbDeviceFont.Items.Add("FontA1x1")
        cmbDeviceFont.Items.Add("FontA1x1[255]")
        cmbDeviceFont.Items.Add("FontA1x1[Ext.]")
        cmbDeviceFont.Items.Add("FontA1x2")
        cmbDeviceFont.Items.Add("FontA1x2[255]")
        cmbDeviceFont.Items.Add("FontA1x2[Ext.]")
        cmbDeviceFont.Items.Add("FontA2x1")
        cmbDeviceFont.Items.Add("FontA2x1[255]")
        cmbDeviceFont.Items.Add("FontA2x1[Ext.]")
        cmbDeviceFont.Items.Add("FontA2x2")
        cmbDeviceFont.Items.Add("FontA2x2[255]")
        cmbDeviceFont.Items.Add("FontA2x2[Ext.]")
        cmbDeviceFont.Items.Add("FontA2x4")
        cmbDeviceFont.Items.Add("FontA2x4[255]")
        cmbDeviceFont.Items.Add("FontA2x4[Ext.]")
        cmbDeviceFont.Items.Add("FontA4x2")
        cmbDeviceFont.Items.Add("FontA4x2[255]")
        cmbDeviceFont.Items.Add("FontA4x2[Ext.]")
        cmbDeviceFont.Items.Add("FontA4x4")
        cmbDeviceFont.Items.Add("FontA4x4[255]")
        cmbDeviceFont.Items.Add("FontA4x4[Ext.]")
        cmbDeviceFont.Items.Add("FontA4x8")
        cmbDeviceFont.Items.Add("FontA4x8[255]")
        cmbDeviceFont.Items.Add("FontA4x8[Ext.]")
        cmbDeviceFont.Items.Add("FontA8x4")
        cmbDeviceFont.Items.Add("FontA8x4[255]")
        cmbDeviceFont.Items.Add("FontA8x4[Ext.]")
        cmbDeviceFont.Items.Add("FontA8x8")
        cmbDeviceFont.Items.Add("FontA8x8[255]")
        cmbDeviceFont.Items.Add("FontA8x8[Ext.]")

        'Font B
        cmbDeviceFont.Items.Add("FontB1x1")
        cmbDeviceFont.Items.Add("FontB1x1[255]")
        cmbDeviceFont.Items.Add("FontB1x1[Ext.]")
        cmbDeviceFont.Items.Add("FontB1x2")
        cmbDeviceFont.Items.Add("FontB1x2[255]")
        cmbDeviceFont.Items.Add("FontB1x2[Ext.]")
        cmbDeviceFont.Items.Add("FontB2x1")
        cmbDeviceFont.Items.Add("FontB2x1[255]")
        cmbDeviceFont.Items.Add("FontB2x1[Ext.]")
        cmbDeviceFont.Items.Add("FontB2x2")
        cmbDeviceFont.Items.Add("FontB2x2[255]")
        cmbDeviceFont.Items.Add("FontB2x2[Ext.]")
        cmbDeviceFont.Items.Add("FontB2x4")
        cmbDeviceFont.Items.Add("FontB2x4[255]")
        cmbDeviceFont.Items.Add("FontB2x4[Ext.]")
        cmbDeviceFont.Items.Add("FontB4x2")
        cmbDeviceFont.Items.Add("FontB4x2[255]")
        cmbDeviceFont.Items.Add("FontB4x2[Ext.]")
        cmbDeviceFont.Items.Add("FontB4x4")
        cmbDeviceFont.Items.Add("FontB4x4[255]")
        cmbDeviceFont.Items.Add("FontB4x4[Ext.]")
        cmbDeviceFont.Items.Add("FontB4x8")
        cmbDeviceFont.Items.Add("FontB4x8[255]")
        cmbDeviceFont.Items.Add("FontB4x8[Ext.]")
        cmbDeviceFont.Items.Add("FontB8x4")
        cmbDeviceFont.Items.Add("FontB8x4[255]")
        cmbDeviceFont.Items.Add("FontB8x4[Ext.]")
        cmbDeviceFont.Items.Add("FontB8x8")
        cmbDeviceFont.Items.Add("FontB8x8[255]")
        cmbDeviceFont.Items.Add("FontB8x8[Ext.]")

        'Korean fonts
        cmbDeviceFont.Items.Add("Korean1x1")
        cmbDeviceFont.Items.Add("Korean1x2")
        cmbDeviceFont.Items.Add("Korean2x1")
        cmbDeviceFont.Items.Add("Korean2x2")
        cmbDeviceFont.Items.Add("Korean2x4")
        cmbDeviceFont.Items.Add("Korean4x2")
        cmbDeviceFont.Items.Add("Korean4x4")
        cmbDeviceFont.Items.Add("Korean4x8")
        cmbDeviceFont.Items.Add("Korean8x4")
        cmbDeviceFont.Items.Add("Korean8x8")

        'Chinese fonts
        cmbDeviceFont.Items.Add("Chinese2312_1x1")
        cmbDeviceFont.Items.Add("Chinese2312_1x2")
        cmbDeviceFont.Items.Add("Chinese2312_2x1")
        cmbDeviceFont.Items.Add("Chinese2312_2x2")
        cmbDeviceFont.Items.Add("Chinese2312_2x4")
        cmbDeviceFont.Items.Add("Chinese2312_4x2")
        cmbDeviceFont.Items.Add("Chinese2312_4x4")
        cmbDeviceFont.Items.Add("Chinese2312_4x8")
        cmbDeviceFont.Items.Add("Chinese2312_8x4")
        cmbDeviceFont.Items.Add("Chinese2312_8x8")

        cmbDeviceFont.Items.Add("ChineseBIG5_1x1")
        cmbDeviceFont.Items.Add("ChineseBIG5_1x2")
        cmbDeviceFont.Items.Add("ChineseBIG5_2x1")
        cmbDeviceFont.Items.Add("ChineseBIG5_2x2")
        cmbDeviceFont.Items.Add("ChineseBIG5_2x4")
        cmbDeviceFont.Items.Add("ChineseBIG5_4x2")
        cmbDeviceFont.Items.Add("ChineseBIG5_4x4")
        cmbDeviceFont.Items.Add("ChineseBIG5_4x8")
        cmbDeviceFont.Items.Add("ChineseBIG5_8x4")
        cmbDeviceFont.Items.Add("ChineseBIG5_8x8")

        'Japanese fonts.
        cmbDeviceFont.Items.Add("Japanese1x1")
        cmbDeviceFont.Items.Add("Japanese1x2")
        cmbDeviceFont.Items.Add("Japanese2x1")
        cmbDeviceFont.Items.Add("Japanese2x2")
        cmbDeviceFont.Items.Add("Japanese2x4")
        cmbDeviceFont.Items.Add("Japanese4x2")
        cmbDeviceFont.Items.Add("Japanese4x4")
        cmbDeviceFont.Items.Add("Japanese4x8")
        cmbDeviceFont.Items.Add("Japanese8x4")
        cmbDeviceFont.Items.Add("Japanese8x8")

        cmbDeviceFont.SelectedIndex = 0

        ' Initialize Cash Drawer Speed
        cmbCashdrawer_Speed.Items.Add("50ms")
        cmbCashdrawer_Speed.Items.Add("100ms")
        cmbCashdrawer_Speed.Items.Add("150ms")
        cmbCashdrawer_Speed.Items.Add("200ms")
        cmbCashdrawer_Speed.Items.Add("250ms")

        cmbCashdrawer_Speed.SelectedIndex = 0

    End Sub


    Private Sub EnableCtrls(ByVal bConnect As Boolean)
        txtPrinterName.Enabled = Not bConnect
        btnConnect.Enabled = Not bConnect
        btnDisconnect.Enabled = bConnect
        cmbDeviceFont.Enabled = bConnect
        btnPrint_DeviceFont.Enabled = bConnect
        btnPrint_Receipt.Enabled = bConnect

        cmbCashdrawer_Speed.Enabled = bConnect
        btnCashdrawer_Open.Enabled = bConnect
        rdoCashdrawer_1.Enabled = bConnect
        rdoCashdrawer_2.Enabled = bConnect
        btnPartialCut.Enabled = bConnect
        btnPartialCut_NoFeed.Enabled = bConnect
    End Sub

    Private Sub btnConnect_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnConnect.Click
        If (BXLAPI.ConnectPrinter(txtPrinterName.Text.Trim())) Then
            EnableCtrls(True)
        End If
    End Sub

    Private Sub btnDisconnect_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnDisconnect.Click
        BXLAPI.DisconnectPrinter()
        EnableCtrls(False)
    End Sub

    Private Sub btnCashdrawer_Open_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnCashdrawer_Open.Click
        Dim strBuffer As String = ""
        Dim nPositionX As Integer = 0
        Dim nPositionY As Integer = 0
        Dim nTextHeight As Integer = 0

        ' Start Document
        If (BXLAPI.Start_Doc("Open Cash Drawer") = False) Then
            Exit Sub
        End If
        ' Start Page
        BXLAPI.Start_Page()

        Select Case cmbCashdrawer_Speed.SelectedIndex
            Case SPEED_50MS
                strBuffer = "a"
            Case SPEED_100MS
                strBuffer = "b"
            Case SPEED_150MS
                strBuffer = "c"
            Case SPEED_200MS
                strBuffer = "d"
            Case SPEED_250MS
                strBuffer = "e"

        End Select

        If (rdoCashdrawer_1.Checked) Then
            strBuffer = strBuffer.ToUpper()
        ElseIf (rdoCashdrawer_2.Checked) Then
            strBuffer = strBuffer.ToLower()
        End If

        Debug.WriteLine("SPEED = " + cmbCashdrawer_Speed.SelectedIndex.ToString() + ", Buffer = " + strBuffer)

        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 0, strBuffer)

        BXLAPI.End_Page()   ' End Page
        BXLAPI.End_Doc()    ' End Document
    End Sub

    Private Sub btnPrint_DeviceFont_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPrint_DeviceFont.Click
        Dim strFontName As String = ""
        Dim strBuffer As String = ""
        Dim nFontSize As Integer = 0
        Dim nPositionX As Integer = 0
        Dim nPositionY As Integer = 0

        ' Start Document
        If (BXLAPI.Start_Doc("Print Device Font") = False) Then
            Exit Sub
        End If
        ' Start Page
        BXLAPI.Start_Page()

        '	Get selected font device name
        strFontName = cmbDeviceFont.Text

        '	Load Font
        nFontSize = 8

        If (strFontName.IndexOf("x2") >= 0) Then
            nFontSize = 17
        ElseIf (strFontName.IndexOf("x4") >= 0) Then
            nFontSize = 34
        ElseIf (strFontName.IndexOf("x8") >= 0) Then
            nFontSize = 68
        Else
            nFontSize = 8
        End If


        If (strFontName.IndexOf("FontB") >= 0) Then
            If (strFontName.IndexOf("x2") >= 0) Then
                nFontSize = 12
            ElseIf (strFontName.IndexOf("x4") >= 0) Then
                nFontSize = 24
            ElseIf (strFontName.IndexOf("x8") >= 0) Then
                nFontSize = 48
            Else
                nFontSize = 6
            End If
        End If

        strBuffer = "FontName: " + strFontName
        nPositionY += BXLAPI.PrintDeviceFont(nPositionX, nPositionY, strFontName, nFontSize, strBuffer)

        strBuffer = "TEST"
        nPositionY += BXLAPI.PrintDeviceFont(nPositionX, nPositionY, strFontName, nFontSize, strBuffer)

        BXLAPI.End_Page()   ' End Page
        BXLAPI.End_Doc()    ' End Document
    End Sub

    Private Sub btnPartialCut_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPartialCut.Click
        Dim nPositionX As Integer = 0
        Dim nPositionY As Integer = 0
        Dim nTextHeight As Integer = 0

        ' Start Document
        If (BXLAPI.Start_Doc("Partial Cut") = False) Then
            Exit Sub
        End If
        ' Start Page
        BXLAPI.Start_Page()

        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "P")

        BXLAPI.End_Page()   ' End Page
        BXLAPI.End_Doc()    ' End Document
    End Sub

    Private Sub btnPartialCut_NoFeed_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPartialCut_NoFeed.Click
        Dim nPositionX As Integer = 0
        Dim nPositionY As Integer = 0
        Dim nTextHeight As Integer = 0

        ' Start Document
        If (BXLAPI.Start_Doc("Partial Cut without Feeding") = False) Then
            Exit Sub
        End If
        ' Start Page
        BXLAPI.Start_Page()

        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "g")

        BXLAPI.End_Page()   ' End Page
        BXLAPI.End_Doc()    ' End Document
    End Sub

    Private Sub btnPrint_Receipt_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPrint_Receipt.Click
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
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "FontControl", 8, "x") ' ALIGNS TEXT TO THE CENTER

        nPositionY += nTextHeight
        nTextHeight = BXLAPI.PrintDeviceFont(nPositionX, nPositionY, "Code128", 18, "123456789012") ' PRINT BARCODE

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
        BXLAPI = Nothing
    End Sub

End Class
