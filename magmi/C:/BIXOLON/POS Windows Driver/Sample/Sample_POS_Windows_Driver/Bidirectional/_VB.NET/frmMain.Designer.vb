<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class frmMain
    Inherits System.Windows.Forms.Form

    'Form은 Dispose를 재정의하여 구성 요소 목록을 정리합니다.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Windows Form 디자이너에 필요합니다.
    Private components As System.ComponentModel.IContainer

    '참고: 다음 프로시저는 Windows Form 디자이너에 필요합니다.
    '수정하려면 Windows Form 디자이너를 사용하십시오.  
    '코드 편집기를 사용하여 수정하지 마십시오.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.GroupBox1 = New System.Windows.Forms.GroupBox
        Me.btnDisconnect = New System.Windows.Forms.Button
        Me.btnConnect = New System.Windows.Forms.Button
        Me.txtPrinterName = New System.Windows.Forms.TextBox
        Me.Label1 = New System.Windows.Forms.Label
        Me.GroupBox4 = New System.Windows.Forms.GroupBox
        Me.btnPrint_Receipt = New System.Windows.Forms.Button
        Me.btnExit = New System.Windows.Forms.Button
        Me.GroupBox2 = New System.Windows.Forms.GroupBox
        Me.btnStatus_Cancel = New System.Windows.Forms.Button
        Me.btnStatus_Set = New System.Windows.Forms.Button
        Me.btnStatus_Get = New System.Windows.Forms.Button
        Me.GroupBox5 = New System.Windows.Forms.GroupBox
        Me.GroupBox1.SuspendLayout()
        Me.GroupBox4.SuspendLayout()
        Me.GroupBox2.SuspendLayout()
        Me.GroupBox5.SuspendLayout()
        Me.SuspendLayout()
        '
        'GroupBox1
        '
        Me.GroupBox1.Controls.Add(Me.btnDisconnect)
        Me.GroupBox1.Controls.Add(Me.btnConnect)
        Me.GroupBox1.Controls.Add(Me.txtPrinterName)
        Me.GroupBox1.Controls.Add(Me.Label1)
        Me.GroupBox1.Location = New System.Drawing.Point(7, 4)
        Me.GroupBox1.Name = "GroupBox1"
        Me.GroupBox1.Size = New System.Drawing.Size(385, 99)
        Me.GroupBox1.TabIndex = 0
        Me.GroupBox1.TabStop = False
        Me.GroupBox1.Text = "Connection"
        '
        'btnDisconnect
        '
        Me.btnDisconnect.Enabled = False
        Me.btnDisconnect.Location = New System.Drawing.Point(199, 57)
        Me.btnDisconnect.Name = "btnDisconnect"
        Me.btnDisconnect.Size = New System.Drawing.Size(170, 31)
        Me.btnDisconnect.TabIndex = 2
        Me.btnDisconnect.Text = "Disconnect Printer"
        Me.btnDisconnect.UseVisualStyleBackColor = True
        '
        'btnConnect
        '
        Me.btnConnect.Location = New System.Drawing.Point(15, 57)
        Me.btnConnect.Name = "btnConnect"
        Me.btnConnect.Size = New System.Drawing.Size(170, 31)
        Me.btnConnect.TabIndex = 2
        Me.btnConnect.Text = "Connect Printer"
        Me.btnConnect.UseVisualStyleBackColor = True
        '
        'txtPrinterName
        '
        Me.txtPrinterName.Location = New System.Drawing.Point(123, 23)
        Me.txtPrinterName.Name = "txtPrinterName"
        Me.txtPrinterName.Size = New System.Drawing.Size(246, 21)
        Me.txtPrinterName.TabIndex = 1
        Me.txtPrinterName.Text = "BIXOLON SRP-350III"
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(12, 26)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(105, 15)
        Me.Label1.TabIndex = 0
        Me.Label1.Text = "PRINTER NAME : "
        '
        'GroupBox4
        '
        Me.GroupBox4.Controls.Add(Me.btnPrint_Receipt)
        Me.GroupBox4.Location = New System.Drawing.Point(7, 109)
        Me.GroupBox4.Name = "GroupBox4"
        Me.GroupBox4.Size = New System.Drawing.Size(385, 60)
        Me.GroupBox4.TabIndex = 3
        Me.GroupBox4.TabStop = False
        Me.GroupBox4.Text = "Print Receipt"
        '
        'btnPrint_Receipt
        '
        Me.btnPrint_Receipt.Enabled = False
        Me.btnPrint_Receipt.Location = New System.Drawing.Point(15, 20)
        Me.btnPrint_Receipt.Name = "btnPrint_Receipt"
        Me.btnPrint_Receipt.Size = New System.Drawing.Size(170, 31)
        Me.btnPrint_Receipt.TabIndex = 0
        Me.btnPrint_Receipt.Text = "Receipt"
        Me.btnPrint_Receipt.UseVisualStyleBackColor = True
        '
        'btnExit
        '
        Me.btnExit.Location = New System.Drawing.Point(222, 310)
        Me.btnExit.Name = "btnExit"
        Me.btnExit.Size = New System.Drawing.Size(170, 31)
        Me.btnExit.TabIndex = 4
        Me.btnExit.Text = "Exit"
        Me.btnExit.UseVisualStyleBackColor = True
        '
        'GroupBox2
        '
        Me.GroupBox2.Controls.Add(Me.btnStatus_Cancel)
        Me.GroupBox2.Controls.Add(Me.btnStatus_Set)
        Me.GroupBox2.Location = New System.Drawing.Point(7, 241)
        Me.GroupBox2.Name = "GroupBox2"
        Me.GroupBox2.Size = New System.Drawing.Size(385, 63)
        Me.GroupBox2.TabIndex = 5
        Me.GroupBox2.TabStop = False
        Me.GroupBox2.Text = "Register Callback (Printer Status)"
        '
        'btnStatus_Cancel
        '
        Me.btnStatus_Cancel.Enabled = False
        Me.btnStatus_Cancel.Location = New System.Drawing.Point(199, 20)
        Me.btnStatus_Cancel.Name = "btnStatus_Cancel"
        Me.btnStatus_Cancel.Size = New System.Drawing.Size(170, 31)
        Me.btnStatus_Cancel.TabIndex = 0
        Me.btnStatus_Cancel.Text = "Unregister Callback"
        Me.btnStatus_Cancel.UseVisualStyleBackColor = True
        '
        'btnStatus_Set
        '
        Me.btnStatus_Set.Enabled = False
        Me.btnStatus_Set.Location = New System.Drawing.Point(15, 20)
        Me.btnStatus_Set.Name = "btnStatus_Set"
        Me.btnStatus_Set.Size = New System.Drawing.Size(170, 31)
        Me.btnStatus_Set.TabIndex = 0
        Me.btnStatus_Set.Text = "Register Callback"
        Me.btnStatus_Set.UseVisualStyleBackColor = True
        '
        'btnStatus_Get
        '
        Me.btnStatus_Get.Enabled = False
        Me.btnStatus_Get.Location = New System.Drawing.Point(15, 20)
        Me.btnStatus_Get.Name = "btnStatus_Get"
        Me.btnStatus_Get.Size = New System.Drawing.Size(170, 31)
        Me.btnStatus_Get.TabIndex = 0
        Me.btnStatus_Get.Text = "Get Printer-Status"
        Me.btnStatus_Get.UseVisualStyleBackColor = True
        '
        'GroupBox5
        '
        Me.GroupBox5.Controls.Add(Me.btnStatus_Get)
        Me.GroupBox5.Location = New System.Drawing.Point(7, 175)
        Me.GroupBox5.Name = "GroupBox5"
        Me.GroupBox5.Size = New System.Drawing.Size(385, 60)
        Me.GroupBox5.TabIndex = 4
        Me.GroupBox5.TabStop = False
        Me.GroupBox5.Text = "Get Printer Status"
        '
        'frmMain
        '
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.None
        Me.ClientSize = New System.Drawing.Size(409, 348)
        Me.Controls.Add(Me.GroupBox5)
        Me.Controls.Add(Me.GroupBox2)
        Me.Controls.Add(Me.btnExit)
        Me.Controls.Add(Me.GroupBox4)
        Me.Controls.Add(Me.GroupBox1)
        Me.Font = New System.Drawing.Font("Arial", 9.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog
        Me.Name = "frmMain"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "Sample"
        Me.GroupBox1.ResumeLayout(False)
        Me.GroupBox1.PerformLayout()
        Me.GroupBox4.ResumeLayout(False)
        Me.GroupBox2.ResumeLayout(False)
        Me.GroupBox5.ResumeLayout(False)
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents GroupBox1 As System.Windows.Forms.GroupBox
    Friend WithEvents btnDisconnect As System.Windows.Forms.Button
    Friend WithEvents btnConnect As System.Windows.Forms.Button
    Friend WithEvents txtPrinterName As System.Windows.Forms.TextBox
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents GroupBox4 As System.Windows.Forms.GroupBox
    Friend WithEvents btnPrint_Receipt As System.Windows.Forms.Button
    Friend WithEvents btnExit As System.Windows.Forms.Button
    Friend WithEvents GroupBox2 As System.Windows.Forms.GroupBox
    Friend WithEvents btnStatus_Cancel As System.Windows.Forms.Button
    Friend WithEvents btnStatus_Set As System.Windows.Forms.Button
    Friend WithEvents btnStatus_Get As System.Windows.Forms.Button
    Friend WithEvents GroupBox5 As System.Windows.Forms.GroupBox

End Class
