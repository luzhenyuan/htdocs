#!/usr/bin/python
#-*- encoding:utf-8 -*-
import sys   #reload()之前必须要引入模块
reload(sys)
sys.setdefaultencoding('utf-8')
import paramiko
import os
import stat
import string
import time

def getAllFilePath(sftp, remote):
    try:
        for attr in sftp.listdir_attr(remote):
            # 判断是否为目录
            if not stat.S_ISDIR(attr.st_mode):
                yield remote + os.sep + attr.filename
    except Exception as e:
        print('getAllFilePath exception:', e)

def uploadToServer(fn):
    # sftp主机
    host='106.52.165.118'
    # sftp端口号
    port=22
    # sftp登录用户名
    username='root'
    # sftp登录密码
    password='2q!jICGdU$hS5hgI'
    # 下载文件至本地目录
    local='E:\\mszc\\server\\zip\\'
    # sftp指定目录
    remote=''
    #private_key = paramiko.RSAKey.from_private_key_file('liumengjun')
    # 建立sftp链接
    sf = paramiko.Transport((host, port))
    #sf.connect(username=username,password=password, pkey=private_key)
    sf.connect(username=username, password=password);
    #sf.connect()
    sftp = paramiko.SFTPClient.from_transport(sf)
    print('upload to:' + host)
    print('starting')
    sftp.put(remote + fn, fn)
    print('upload ok:' + fn)
    sf.close()
def tar(fn,path):
    # sftp主机
    host='106.52.165.118'
    # sftp端口号
    port=22
    # sftp登录用户名
    username='root'
    # sftp登录密码
    password='2q!jICGdU$hS5hgI'
    # 下载文件至本地目录
    local='E:\\mszc\\server\\zip\\'
    # sftp指定目录
    remote=''
    ssh = paramiko.SSHClient()
    ssh.load_system_host_keys()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    #ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    conn = ssh.connect(host, username=username, port=22,password=password)
    # 建立sftp链接
    stdin, stdout, stderr = ssh.exec_command('tar xvfz ' + fn + ' -C ' + path)
    result = stdout.read()
    print(result.decode())
    ssh.close()

def commandServer(command):
    # sftp主机
    host='106.52.165.118'
    # sftp端口号
    port=22
    # sftp登录用户名
    username='root'
    # sftp登录密码
    password='2q!jICGdU$hS5hgI'
    # sftp指定目录
    remote=''
    #private_key = paramiko.RSAKey.from_private_key_file('liumengjun')
    # setup ssh connection this works. no problem.
    ssh = paramiko.SSHClient()
    ssh.load_system_host_keys()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    #ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    conn = ssh.connect(host, username=username, port=22,password=password)
    # 建立sftp链接
    stdin, stdout, stderr = ssh.exec_command(command)
    result = stdout.read()
    print(result.decode())
    ssh.close()

if __name__ == '__main__':
    arglen = len(sys.argv);
    if arglen == 4:
        sys.argv[1] = sys.argv[1]+' '+sys.argv[2]+' '+sys.argv[3]
        del sys.argv[2]
        del sys.argv[2]
    # print(sys.argv,arglen)
    if arglen != 2 and arglen != 4:
		print('arglen error:' + str(arglen))
    else:
		print('sys.argv[0]:' + sys.argv[1])
		commandServer(sys.argv[1])
		time.sleep(3)
		print('Success!')